<?php
/**
 * Controller
 *
 * Titulo: Destaques do Site
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use Model\DestaqueSite;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class DestaqueSiteController
 * @package Modules\Generic\Controllers
 * @Title: Destaques do Site
 */
class DestaqueSiteController extends Controller
{

    /**
     * @Title: Listagem
     */
    public function index()
    {
        $this->loadModel();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

    /**
     * @Title: Cadastro
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadModel();
        $Model = new DestaqueSite();
        $Model->DestaqueSiteId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "Model\\DestaqueSiteId");
            // select
            $this->loadModel();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    $this->bll->Save($model); // Salva
                    $this->Redirect("Index"); // Redireciona pra index do controller
                }
            }
        }else{
            $model = new \stdClass();
        }

        $this->ModelView($model);
    }

    public function deletar($id){
        if($id > 0){
            $this->loadModel();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}