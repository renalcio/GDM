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

    public function Index($model)
    {
        $termo = isset($model["q"]) ? $model["q"] : $model;
        $termo = strtolower($termo);
        $Model = new Busca();
        $Model->Termo = $termo;
        $Model->ListArtista = $this->unitofwork->Get(new Artista(), "LOWER(Titulo) LIKE '%".$termo."%'")
            ->ToList();
        $Model->ListMusica = $this->unitofwork->Get(new Musica(), "LOWER(Titulo) LIKE '%".$termo."%'")->ToList();

        return $Model;
    }
}