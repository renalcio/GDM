<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 30/04/2015
 *
 */
namespace Modules\ClassHub\Controllers;
use Core\Controller;
use DAL\ClassHub\Materia;
use DAL\ClassHub\MateriaCurso;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Vinculos de Matérias
 *
 */
class MateriaCursoController extends Controller
{
	/**
	 *
	 * @Title: Listagem
	 *
	 */
    public function index($id = 0)
    {
        $this->AddAsset(["iCheck"]);
        $this->loadBLL();
        $Model = new \stdClass();
        $Model->Materia = new Materia();
        $Model->Materia->MateriaId = $id;
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

	/**
	 *
	 * @Title: Cadastro
	 *
	 */
    public function cadastro()
    {
        // load views
        $this->loadBLL();
        $Model = new MateriaCurso();
        $this->ModelView($Model);

    }

    public function cadastro_post($id = 0, $model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new MateriaCurso);
            $this->loadBLL();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    $this->bll->Save($model); // Salva
                    $this->Redirect(""); // Redireciona pra index do controller
                }
            }
        }else{
            $model = new \stdClass();
        }

        $this->Redirect("Index");
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