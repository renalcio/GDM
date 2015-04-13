<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 13/04/2015
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use DAL\Mensagem;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Mensagens
 *
 */
class MensagemController extends Controller
{
	/**
	 *
	 * @Title: Caixa de Entrada
	 *
	 */
    public function index()
    {
        $this->loadBLL();
        $Model = new \stdClass();
        $this->ModelView($Model);
    }

	/**
	 *
	 * @Title: Nova Mensagem
	 *
	 */
    public function escrever()
    {
        // load views
        $this->loadBLL();
        $Model = new Mensagem();
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function escrever_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Mensagem);
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

    /**
     *
     * @Title: Nova Mensagem
     *
     */
    public function ler($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Mensagem();
        $Model->MensagemId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function deletar($id){
        if($id > 0){
            $this->loadBLL();
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}