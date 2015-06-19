<?php
/**
 * Controller
 *
 * Autor: TANDA
 * Data: 19/06/2015
 *
 */
namespace Controllers;
use Core\Controller;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Calendário
 *
 */
class CalendarioController extends Controller
{
	/**
	 *
	 * @Title:
	 *
	 */
    public function index()
    {
        $this->AddAsset(["fullcalendar"]);
        $this->loadBLL();
        $Model = new \stdClass();
        //$Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

	/**
	 *
	 * @Title: Novo evento
	 *
	 */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new \stdClass();
        $Model->EventoId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new \stdClass);
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
        $this->loadBLL();
        if(isset($_POST["DeleteItems"]) && !empty($_POST["DeleteItems"]) && is_array($_POST["DeleteItems"])) {
            foreach($_POST["DeleteItems"] as $item){
                $this->bll->Deletar($item);
            }
        }else if(!empty($id)){
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index");
    }
}