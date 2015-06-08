<?php
/**
 * Controller
 *
 * Titulo: Site de Aplicação
 * Autor: renalcio.freitas
 * Data: 22/01/2015
 *
 */
namespace Modules\GDM\Controllers;
use Core\Controller;
use Model\Site;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class siteController
 * @package Modules\GDM\Controllers
 * @Title: Sites
 */
class siteController extends Controller
{

    /**
     * @Title: Listagem
     */
    public function index()
    {
        $this->loadBLL();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

    /**
     * @param int $id
     * @Title: Cadastro
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Site();
        $Model->SiteId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "Model\\Site");
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