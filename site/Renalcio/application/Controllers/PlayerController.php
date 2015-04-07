<?php
/**
 * Controller
 *
 * Titulo: Player Controller
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 *
 */
namespace Controllers;
use Core\Controller;
use DAL\MediaSpot\Player;
use Libs\Helper;
use Libs\ModelState;

class PlayerController extends Controller
{

    public function Index($ArtistaId = 0, $MusicaId = 0)
    {
        $this->loadBLL();
        $Model = null;
        if(!empty($ArtistaId)) {
            $Model = $this->bll->Index($ArtistaId, $MusicaId);
        }
        $this->ModelView($Model);
    }
}