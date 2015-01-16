<?php
/**
 * Controller
 *
 * Titulo: Permissão Controller
 * Autor: renalcio.freitas
 * Data: 16/01/2015
 *
 */
namespace Controllers;
use Core\Controller;
use Libs\Helper;
use Libs\ModelState;

class permissaoController extends Controller
{

    public function index()
    {
        $this->loadModel();
        $Model = new \stdClass();
        $Model = $this->model->GetToIndex($Model);
        $this->ModelView($Model);
    }

    public function cadastro($id = 0)
    {
        // load views
        $this->loadModel();
        $Model = new \stdClass();
        $Model->Id = $id;
        $Model = $this->model->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "\\stdClass");
            $this->loadModel();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->model->Validar($model);

                if(ModelState::isValid()) {
                    $this->model->Save($model); // Salva
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
            $this->model->Deletar($id);
        }

        $this->Redirect("Index");
    }
}