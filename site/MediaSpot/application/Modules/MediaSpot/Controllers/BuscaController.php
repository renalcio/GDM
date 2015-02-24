<?php
/**
 * Controller
 *
 * Titulo: Busca Controller
 * Autor: renalcio.freitas
 * Data: 24/02/2015
 *
 */
namespace Controllers;
use Core\Controller;
use DAL\MediaSpot\Busca;
use Libs\Helper;
use Libs\ModelState;

class BuscaController extends Controller
{

    public function index($model)
    {
        $this->loadBLL();
        $Model = new Busca();
        $Model = $this->bll->Index($model);
        if($Model->ListArtista->Count() == 1){
            $this->Redirect("", "Player", $Model->ListArtista->First()->ArtistaId);
        }else if($Model->ListMusica->Count() == 1){
            $this->Redirect("", "Player", Array($Model->ListArtista->First()->ArtistaId, $Model->ListMusica->First()
                ->MusicaId));
        }else {
            $this->ModelView($Model);
        }
    }
}