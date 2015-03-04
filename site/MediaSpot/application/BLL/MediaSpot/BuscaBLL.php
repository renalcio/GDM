<?php
/**
 * Model
 * Titulo: Busca BLL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace BLL;
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
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        parent::__construct();
    }

    public function Index($termo)
    {
        $termo = strtolower($termo);
        $Model = new Busca();
        $Model->Termo = $termo;
        //var_dump($termo);
        //$Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
        // $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();

        if($Model->ListArtista->Count() == 0 && $Model->ListMusica->Count() == 0){
            $Artistas = new ListHelper();

            $Artistas = $this->BuscaArtistaLFM($termo);

        }

        return $Model;
    }

    public function GetMusicasLFM(Artista $Artista, $pagina = 1, $limite = 30){


        CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

        $musicas = Artist::getTopTracks($Artista->Titulo, $Artista->mbid, $limite, $pagina);

        foreach($musicas as $key => $musica) {

            //Adiciona ao banco de dados

            $mAdd = new Musica();

            $mAdd->ArtistaId = $Artista->ArtistaId;

            $mAdd->Titulo = MusicaNome($musica->getName());

            //$mAdd->MusicaId = $this->unitofwork->Insert($mAdd);
        }
        //print_r($musicas);
    }


    public function BuscaArtistaLFM($termo){

        CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

        # --------------- Busca por Artista ------------------ #

        #Passo 2: Buscar no WebService

        /*$WsUrl = LastFM::getUrl($q, 'artist.search', 'artist');

        echo $WsUrl."<br><Br>";*/

        // set api key

        $retorno = Array();

        $limit = 2;

        $results = Artist::search($termo, $limit);

        print_r($results);

        while ($artist = $results->current()) {

            $artista = new Artista();

            //Busca Biografia

            $lfArtist = Artist::getInfo($artist->getName(), $artist->getMbid(), "pt");

            $biografia = preg_replace("/<(.*)>(.*)<\/a>/i", "$2", $lfArtist->getBiography());

            $biografia = explode("Read more about", $biografia);

            $biografia = $biografia[0];

            $artista->Descricao = FormataTexto($biografia);

            //Popula objeto Artista

            $artista->Titulo =  FormataTexto($artist->getName());

            $artista->mbid =  $artist->getMbid();

            $artista->Imagem = $artist->getImage();

            $artista->Ativo = 1;

            $artista->md5 = md5(strtolower($artista->Titulo));

            $retorno[] = $artista;

            $artist = $results->next();
        }



        foreach($retorno as $element){

            $hash = $element->Titulo;

            $retornoFiltrado[$hash] = $element;

        }



        $retorno = new ListHelper();



        foreach($retornoFiltrado as $itemAdd){



            //Salvar Objeto Artista

            //$bdQuery = $pdof->select("SELECT * FROM Artista WHERE md5 = '".$itemAdd->md5."'");



            /*if(count($bdQuery)==0){

                $itemAdd->ArtistaId = $pdof->insert("Artista", (Array)$itemAdd);

            }else{

                $itemAdd->ArtistaId = $bdQuery[0]->ArtistaId;

            }*/

            $itemAdd->Musicas = $this->GetMusicasLFM($itemAdd);

            //$itemAdd->Similar = BuscaRelacionados($itemAdd);



            $retorno->Add($itemAdd);

        }

        print_r($retorno);





        return $retorno;

    }

    function MusicaNome($texto){
        $este = Array("´");
        $por = Array("'");
        return str_replace( $este, $por, $texto);
    }
}