<?php
/**
 * Controller
 *
 * Titulo: Artista
 * Autor: renalcio.freitas
 * Data: 26/01/2015
 *
 */
namespace Modules\MediaSpot\Controllers;
use Core\Controller;
use Model\MediaSpot\Artista;
use Libs\Helper;
use Libs\ModelState;

/**
 * Class ArtistaController
 * @package Modules\MediaSpot\Controllers
 * @Title: Artistas
 */
class ArtistaController extends Controller
{

    /**
     * @Title: Listagem
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
     * @param int $id
     * @Title: Cadastro
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new Artista();
        $Model->ArtistaId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null){

        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, new Artista());
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
            $model = new Artista();
        }
        $this->ModelView($model);

        var_dump($model);
    }

    public function deletar($id = 0){
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