<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use DAL\Aplicacao;

/**
 * Class AplicacaoController
 * @package Modules\GDM\Controllers
 * @Title: Aplicações
 */
class AplicacaoController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     * @Title: Listagem
     */
    public function index()
    {
        $model = new \stdClass();
        $this->loadBLL();
        $model = $this->bll->GetToIndex($model);

        $this->ModelView($model);
    }

    /**
     * @param int $id
     * @Title: Cadastro
     */
    public function cadastro($id = 0)
    {
        $this->Asset(["bootstrap-markdown"]);
        $model = new Aplicacao();
        $model->AplicacaoId = $id;
        $this->loadBLL();

        $model = $this->bll->GetToEdit($model);

        $this->ModelView($model);
    }

    public function cadastro_post($model = null)
    {
        $this->loadBLL();
        //echo "<pre>";
        $this->bll->Save($model);
        //echo "</pre>";
        $this->Redirect("Index");
    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}
