<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 23/04/2015
 *
 */
namespace Modules\ClassHub\Controllers;
use Core\Controller;
use DAL\ClassHub\Turma;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Turmas
 *
 */
class TurmaController extends Controller
{
	/**
	 *
	 * @Title: Listagem
	 *
	 */
    public function index()
    {
        $this->AddAsset(["iCheck"]);
        $this->loadBLL();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

	/**
	 *
	 * @Title: Cadastro
	 *
	 */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Turma();
        $Model->TurmaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Turma);
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