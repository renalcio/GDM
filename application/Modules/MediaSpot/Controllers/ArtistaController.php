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
use DAL\MediaSpot\Artista;
use Libs\Helper;
use Libs\ModelState;

class ArtistaController extends Controller
{

    public function index()
    {
        $this->loadBLL();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Artista();
        $Model->ArtistaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Artista());
            $this->loadBLL();

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
            $model = new Artista();
        }
        $this->ModelView($model);

        var_dump($model);
    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}