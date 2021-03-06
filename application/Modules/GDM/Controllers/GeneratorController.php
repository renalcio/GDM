<?php
/**
 * Controller
 *
 * Titulo: Generator
 * Autor: renalcio.freitas
 * Data: 01/04/2015
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use Model\Aplicacao;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class GeneratorController
 * @package Modules\GDM\Controllers
 * @Title: Gerador
 */
class GeneratorController extends Controller
{

    /**
     * @Title: Model
     */
    public function DAL()
    {
        $this->View();
    }


    public function DAL_post($model=null)
    {
        $Aplicacao = new Aplicacao();
        $Aplicacao = $this->unitofwork->GetById(new Aplicacao(), $model['AplicacaoId']);
        $gerador = null;
        if($Aplicacao!=null) {
            $gerador = new \Libs\ClassGenerator\ClassGenerator($Aplicacao->Pasta);
            $gerador->run();
        }

        $this->View();
        //var_dump($Aplicacao);
    }

    /**
     * @Title: Assets
     */
    public function Assets(){
        $this->View();
    }

    public function Assets_post($model=null){
            $this->View();
    }
}