<?php
/**
 * Controller
 *
 * Titulo: Modulos
 * Autor: renalcio.freitas
 * Data: 18/03/2015
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use DAL\Modulo;
use Libs\Helper;
use Libs\ModelState;

class ModuloController extends Controller
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
        $Model = new Modulo();
        $Model->ModuloId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Modulo());
            if(!empty($model->Actions) && is_array($model->Actions)){
                foreach($model->Actions as $i=>$item){
                    Helper::cast($model->Actions[$i], new \stdClass());
                    $model->Actions[$i]->Publico = (isset($model->Actions[$i]->Publico) && $model->Actions[$i]->Publico == "on") ? 1 : 0;
                }
            }

            $this->loadBLL();

            //var_dump($model);

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    //var_dump($model);
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
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}