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
use Model\ClassHub\Materia;
use Model\ClassHub\MateriaCurso;
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
    public function index($id = 0, $materiacursoid = 0)
    {
        $this->AddAsset(["iCheck"]);
        $this->loadBLL();
        $Model = new \stdClass();
        $Model->Materia = new Materia();
        $Model->Materia->MateriaId = $id;
        $Model->MateriaCurso = new MateriaCurso();
        $Model->MateriaCurso->MateriaCursoId = $materiacursoid;
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

    public function index_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new MateriaCurso);
            $this->loadBLL();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            //var_dump($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    $this->bll->Save($model); // Salva
                    $this->Redirect("index", "MateriaCurso", $model->MateriaId); // Redireciona pra index do
                    // controller
                }
            }
        }else{
            $model = new MateriaCurso();
            $this->Redirect("Index", "Materia");
        }
    }

    public function deletar($id){
        $this->loadBLL();
        if(isset($_POST["DeleteItems"]) && !empty($_POST["DeleteItems"]) && is_array($_POST["DeleteItems"])) {
            foreach($_POST["DeleteItems"] as $item){
                $model = $this->unitofwork->GetById(new MateriaCurso(), $item);
                $this->bll->Deletar($item);
            }
        }else if(!empty($id)){
            $model = $this->unitofwork->GetById(new MateriaCurso(), $id);
            $this->bll->Deletar($id);
        }

        $this->Redirect("Index", "MateriaCurso", $model->MateriaCursoId);
    }
}