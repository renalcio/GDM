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

    /**
     * @Public
     */
    public function index($termo = "")
    {
        $this->loadBLL();
        $Model = new Busca();

        if(empty($termo)){
            $termo = (isset($_REQUEST["q"]) && !empty($_REQUEST["q"])) ? $_REQUEST["q"] : "";
        }

        if(is_array($termo))
            $termo = $termo["q"];

        if(is_object($termo))
            $termo = $termo->q;


        //var_dump($termo);
        if(!empty($termo))
            $Model = $this->bll->Index($termo);


        if($Model->ListArtista->Count() == 1){
            $this->Redirect("", "Player", $Model->ListArtista->First()->ArtistaId);
        }else {
            $this->ModelView($Model);
        }
        //var_dump($Model);


    }
}