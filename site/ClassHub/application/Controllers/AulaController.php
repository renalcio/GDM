<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 *
 */
namespace Modules\ClassHub\Controllers;
use Core\Controller;
use Model\ClassHub\Aula;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Aulas
 *
 */
class AulaController extends Controller
{
	/**
	 *
	 * @Title: Listagem de Aulas
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
        $this->AddAsset(["bootstrap-markdown", "file-upload"]);
        // load views
        $this->loadBLL();
        $Model = new Aula();
        $Model->AulaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);
        //var_dump($Model->ListAulaArquivo);

    }

	/**
	 *
	 * @Title: Cadastro
	 *
	 */
    public function upload($id = 0)
    {
        $this->AddAsset(["bootstrap-markdown", "file-upload"]);
        $this->Template("ClassHub/HeaderSemBarra", "ClassHub/FooterSemBarra");
        // load views
        $this->loadBLL();
        $Model = new Aula();
        $Model->AulaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);
        //var_dump($Model->ListAulaArquivo);

    }

    public function cadastro_post($model = null){

        $this->AddAsset(["bootstrap-markdown", "file-upload"]);

        //var_dump($_REQUEST);
        //var_dump($model);
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Aula);
            $this->loadBLL();

            //Valida Model via ModelState
            ModelState::ValidateModel($model);

            if(ModelState::isValid()) {
                //Valida model via Model
                $this->bll->Validar($model);

                if(ModelState::isValid()) {
                    $this->bll->Save($model); // Salva
                    //$this->Redirect("Index"); // Redireciona pra index do controller
                }
            }
        }else{
            $model = new \stdClass();
        }

        //$this->ModelView($model);
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