<?php
/**
 * Controller
 *
 * Titulo: Notificações
 * Autor: renalcio.freitas
 * Data: 09/04/2015
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use Model\Notificacao;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class NotificacaoController
 * @package Modules\Generic\Controllers
 * @Title: Notificações
 */
class NotificacaoController extends Controller
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
        $this->AddAsset(["datepicker"]);
        // load views
        $this->loadBLL();
        $Model = new Notificacao();
        $Model->NotificacaoId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Notificacao);
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