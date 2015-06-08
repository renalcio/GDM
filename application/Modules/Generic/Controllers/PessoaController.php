<?php

/**
 * Class
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use Model\Pessoa;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class PessoaController
 * @package Modules\Generic\Controllers
 * @Title: Pessoas
 */
class PessoaController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     * @Title: Listagem
     */
    public function index()
    {
        // load views
        $this->loadBLL();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }


    /**
     * PAGE: exampletwo
     * @Title: Cadastro
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new \stdClass();
        $Model->PessoaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $this->loadBLL();
            $this->bll->Save($model);
        }
        $this->Redirect("Index", "pessoa");
    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}
