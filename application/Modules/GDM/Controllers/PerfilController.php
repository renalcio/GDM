<?php

/**
 * Class Pessoas
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use DAL\Perfil;

class PerfilController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
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
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Perfil();
        $Model->PerfilId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $this->loadBLL();
            $this->bll->Save($model);
        }
        $this->Redirect("Index");
    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }

    public function acesso($id){
        // load views
        $this->loadBLL();
        $Model = new \stdClass();
        $Model->PerfilId = $id;
        $Model = $this->bll->Acesso($Model);
        $this->ModelView($Model);
    }
}
