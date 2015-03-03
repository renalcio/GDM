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
        $Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();
        $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();

        return $Model;
    }

    public function GetArtistaLFM(Artista $Artista, $pagina = 1, $limite = 30){


        CallerFactory::getDefaultCaller()->setApiKey("53b09495de54c998614b6d350a5c2d3e");

        $musicas = Artist::getTopTracks($Artista->Titulo, $Artista->mbid, $limite, $pagina);

        foreach($musicas as $key => $musica) {

            //Adiciona ao banco de dados

            $mAdd = new Musica();

            $mAdd->ArtistaId = $Artista->ArtistaId;

            $mAdd->Titulo = MusicaNome($musica->getName());

            $mAdd->MusicaId = $this->unitofwork->Insert($mAdd);
        }
    }

    function MusicaNome($texto){
        $este = Array("´");
        $por = Array("'");
        return str_replace( $este, $por, $texto);
    }
}