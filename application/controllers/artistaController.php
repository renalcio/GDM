<?php
/**
 * Controller
 *
 * Titulo: Artista
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 *
 */
namespace Controllers;
use Core\Controller;
use DAL\Artista;
use Libs\Helper;
use Libs\ModelState;

class ArtistaController extends Controller
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
        $Model = new Artista();
        $Model->ArtistaId = $id;
        $Model = $this->model->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Artista");
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