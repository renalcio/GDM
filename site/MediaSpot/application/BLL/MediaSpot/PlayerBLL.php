<?php
/**
 * Model
 * Titulo: Player BLL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace BLL\MediaSpot;
use BLL\BLL;
use DAL\MediaSpot\Player;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class PlayerBLL extends BLL
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

    public function Index($ArtistaId, $MusicaId)
    {
        $model = new Player($ArtistaId, $MusicaId);
        return $model;
    }
}
