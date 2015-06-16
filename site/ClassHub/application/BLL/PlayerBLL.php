<?php
/**
 * Model
 * Titulo: Player BLL
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 */
namespace BLL;
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
    public function Index($ArtistaId, $MusicaId)
    {
        $model = new Player($ArtistaId, $MusicaId);
        return $model;
    }
}
