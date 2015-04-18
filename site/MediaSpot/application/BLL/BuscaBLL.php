<?php
/**
 * Model
 * Titulo: Busca BLL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace BLL;
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

include_once (APP . "Libs/lastfm/lastfmapi.php");

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

        if($Model->ListArtista->Count() == 0 || $Model->ListMusica->Count() == 0){


            $this->BuscaLastFM($termo);
            $Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
            $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
        }

        return $Model;
    }

    public function BuscaLastFM($termo, $pagina = 1, $limite = 30){
        // Setup the variables
        $methodVars = array(
            'track' => $termo,
            'page' => $pagina,
            'limit' => $limite
        );

        $trackClass = StartLFM();
        $artistClass = StartLFM('artist');

        if ( $results = $trackClass->search($methodVars) ) {
           if(isset($results["results"])){
               foreach($results["results"] as $i=>$item){
                   $clsArtista = new Artista();
                   $clsMusica = new Musica();
                   $clsArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) = LOWER('".$item["artist"]."')
                   ")->First();
                   if(empty($clsArtista) || $clsArtista->ArtistaId <= 0){
                       $clsArtista = new Artista();
                       $artistVars = array(
                           'artist' => $item['artist']
                       );
                       if ( $artist = $artistClass->getInfo($artistVars) ) {
                           $clsArtista->Titulo = @$artist['name'];
                           $clsArtista->Descricao = @$artist['content'];
                           $clsArtista->Imagem = @$artist['image']['large'];
                           $clsArtista->Ativo = 1;
                           $clsArtista->md5 = md5(strtolower($clsArtista->Titulo));
                           $clsArtista->mbid = @$artist['mbid'];
                           $clsArtista->Visitas = 0;
                           $clsArtista->AplicacaoId = APPID;
                           $clsArtista->Relacionados = '';
                           if(isset($artist['similar']) && count($artist['similar']) > 0){
                               foreach($artist['similar'] as $r=>$rel){
                                   $clsArtista->Relacionados .= $rel['name'].(($i < count($artist['similar'])) ? ","
                                           : "");
                               }
                           }
                           $this->unitofwork->Insert($clsArtista);
                       }
                   }
                   //var_dump($clsArtista);
                   $clsMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) = LOWER('".$item["name"]."') AND
                   ArtistaId = '".$clsArtista->ArtistaId."'")->First();
                   if(empty($clsMusica) || $clsMusica->MusicaId <= 0){
                       $clsMusica = new Musica();
                       $clsMusica->Titulo = $item["name"];
                       $clsMusica->AplicacaoId = APPID;
                       $this->unitofwork->Insert($clsMusica);
                   }
               }
           }
        }
        else {
            die('<b>Error '.$trackClass->error['code'].' - </b><i>'.$trackClass->error['desc'].'</i>');
        }
    }

    public function FormataTexto($texto=""){
        $este = Array("´");
        $por = Array("'");
        return str_replace( $este, $por, $texto);
    }
}