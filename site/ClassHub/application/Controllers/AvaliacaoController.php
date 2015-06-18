<?php
/**
 * Controller
 *
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 *
 */
namespace Controllers;
use Core\Controller;
use Model\ClassHub\Avaliacao;
use Libs\Helper;
use Libs\ModelState;

/**
 *
 * @Title: Avaliações
 *
 */
class AvaliacaoController extends Controller
{
	/**
	 *
	 * @Title: Listagem de Avaliações
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
     * @Title: Detalhes
     *
     */
    public function detalhes($id = 0)
    {
        $this->AddAsset(["bootstrap-markdown", "file-upload", "iCheck"]);
        $this->Template("_templates/HeaderSemBarra", "_templates/FooterSemBarra");
        // load views
        $this->loadBLL();
        $Model = new Avaliacao();
        $Model->AvaliacaoId = $id;
        $Model = $this->bll->GetToDetails($Model);
        $isTurma = ($Model->TurmaId == \Libs\AlunoHelper::GetUsuarioAluno()->TurmaId) ? true : false;
        if($isTurma || empty($Model->AvaliacaoId)) {
            $this->ModelView($Model);
        }else{
            $this->Redirect("Index");
        }
        //var_dump($Model->ListAvaliacaoArquivo);

    }

    /**
     *
     * @Title: Cadastro
     *
     */
    public function cadastro($id = 0)
    {
        $this->AddAsset(["bootstrap-markdown", "file-upload", "iCheck"]);
        // load views
        $this->loadBLL();
        $Model = new Avaliacao();
        $Model->AvaliacaoId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $isTurma = ($Model->TurmaId == \Libs\AlunoHelper::GetUsuarioAluno()->TurmaId) ? true : false;
        if($isTurma || empty($Model->AvaliacaoId)) {
            $this->ModelView($Model);
        }else{
            $this->Redirect("Index");
        }
        //var_dump($Model->ListAvaliacaoArquivo);

    }

	/**
	 *
	 * @Title: Cadastro
	 *
	 */
    public function upload($id = 0)
    {
        $this->AddAsset(["bootstrap-markdown", "file-upload"]);
        $this->Template("_templates/HeaderSemBarra", "_templates/FooterSemBarra");
        // load views
        $this->loadBLL();
        $Model = new Avaliacao();
        $Model->AvaliacaoId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);
        //var_dump($Model->ListAvaliacaoArquivo);

    }

    public function cadastro_post($model = null){

        $this->AddAsset(["bootstrap-markdown", "file-upload"]);

        //var_dump($_REQUEST);
        //var_dump($model);
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Avaliacao);
            $this->loadBLL();

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