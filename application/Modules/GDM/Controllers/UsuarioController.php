<?php

/**
 * Class
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use Dal\Pessoa;
use DAL\Usuario;
use Libs\Helper;
use Libs\ModelState;

class UsuarioController extends Controller
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
        $this->Asset(["jquery.cropper"]);
        // load views
        $this->loadBLL();
        $Model = new Usuario();
        $Model->UsuarioId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
           /* echo "<pre>";
            var_dump($model);
            echo "</pre>";*/
            $model = (object)$model;
            Helper::cast($model, "DAL\\Usuario");
            Helper::cast($model->Pessoa, "DAL\\Pessoa");
            Helper::cast($model->Pessoa->PessoaFisica, "DAL\\PessoaFisica");
            Helper::cast($model->Pessoa->PessoaJuridica, "DAL\\PessoaJuridica");

            $this->loadBLL();

            //Valida Model
            ModelState::ValidateModel($model);
            ModelState::ValidateModel($model->Pessoa);

            if(ModelState::isValid()) {

                $validacao = $this->bll->Validar($model);

                if (ModelState::isValid()) {
                    $this->bll->Save($model);
                    $this->Redirect("Index", "usuario");
                }

                $this->ModelView($model);
            }else{
                $this->ModelView($model);
            }
        }
    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}
