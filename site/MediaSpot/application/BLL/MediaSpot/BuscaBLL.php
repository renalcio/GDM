<?php
/**
 * Model
 * Titulo: Busca BLL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace BLL\MediaSpot;
use BLL\BLL;
use DAL\MediaSpot\Artista;
use DAL\MediaSpot\Busca;
use DAL\MediaSpot\Musica;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ListHelper;
use Libs\ModelState;
use Libs\Session;
use Libs\UnitofWork;
use Libs\Usuario;
use Libs\Debug;

include_once (APP . "Libs/lastfm/lastfm.api.php");

class BuscaBLL extends BLL
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db = null)
    {
        if(!empty($db)) {
            try {
                $this->db = $db;
            } catch (PDOException $e) {
                exit('Database connection could not be established.');
            }
        }
        parent::__construct();
    }

    public function Index($termo)
    {
        $termo = strtolower($termo);
        $Model = new Busca();
        $Model->Termo = $termo;
        $Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
        $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();

        if($Model->ListArtista->Count() == 0 && $Model->ListMusica->Count() == 0){

            $this->BuscaArtistaLFM($termo);
            $Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
            $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
        }

        return $Model;
    }

    public function GetMusicasLFM(Artista $Artista, $pagina = 1, $limite = 30){


        \CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

        $musicas = \Artist::getTopTracks($Artista->Titulo, $Artista->mbid, $limite, $pagina);

        $retorno = Array();
        foreach($musicas as $key => $musica) {
            //Adiciona ao banco de dados

            $mAdd = new Musica();

            $mAdd->AplicacaoId = APPID;

            $mAdd->ArtistaId = $Artista->ArtistaId;

            $mAdd->Titulo = $this->FormataTexto($musica->getName());

            $this->unitofwork->Insert($mAdd);
            $retorno[] = $mAdd;
        }
    }


    public function BuscaArtistaLFM($termo){

        \CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

        # --------------- Busca por Artista ------------------ #

        #Passo 2: Buscar no WebService
        /*$WsUrl = LastFM::getUrl($q, 'artist.search', 'artist');
        echo $WsUrl."<br><Br>";*/
        // set api key

        $retorno = Array();

        $limit = 8;

        $results = \Artist::search($termo, $limit);


        while ($artist = $results->current()) {

            $artista = new Artista();

            //Busca Biografia

            $lfArtist = \Artist::getInfo($artist->getName(), $artist->getMbid(), "pt");

            $biografia = preg_replace("/<(.*)>(.*)<\/a>/i", "$2", $lfArtist->getBiography());

            $biografia = explode("Read more about", $biografia);

            $biografia = $biografia[0];

            $artista->Titulo =  $this->FormataTexto($artist->getName());

            $artista->Descricao = $this->FormataTexto($biografia);

            $artista->Imagem = $artist->getImage();

            $artista->Ativo = 1;

            $artista->md5 = md5(strtolower($artista->Titulo));

            $artista->mbid =  $artist->getMbid();

            $artista->AplicacaoId = APPID;

            $artista->Visitas = 0;

            $retorno[] = $artista;

            $artist = $results->next();
        }



        foreach($retorno as $element){

            $hash = $element->Titulo;

            $retornoFiltrado[$hash] = $element;

        }

        $retorno = new ListHelper();

        foreach($retornoFiltrado as $itemAdd){

            if(isset($itemAdd) && !empty($itemAdd)) {

                $itemAdd->Relacionados = $this->BuscaRelacionadosLFM($itemAdd);

                $check = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) = '" . strtolower($itemAdd->Titulo) . "'")->ToList();

                if($check->Count() == 0) {
                    $this->unitofwork->Insert($itemAdd);
                    $this->GetMusicasLFM($itemAdd);
                }
            }

        }

    }

    public function BuscaRelacionadosLFM($Artista){

        \CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");
        //Musicas
        $array = Array();
        $retorno = "";

        $relacionados = \Artist::getInfo($Artista->Titulo, $Artista->mbid, "pt")->getSimilarArtists();

        $i = 0;

        foreach($relacionados as $key => $relacionado) {
            if($i < 5){
                $array[] = $relacionado->getName();
            }
            $i++;
        }

        foreach($array as $element){

            $hash = $element;

            $retornoFiltrado[$hash] = $element;

        }

        $array = Array();

        $array = $retornoFiltrado;


        $n = 1;
        foreach($array as $itemadd){
            $retorno .= $itemadd . (($n < count($array)) ? "," : "");
            $n++;
        }

        return $retorno;

    }

    public function FormataTexto($texto=""){
        $este = Array("´");
        $por = Array("'");
        return str_replace( $este, $por, $texto);
    }
}