<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Controllers;
use Core\Controller;
class AppController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $model = new \stdClass();
        $this->loadModel();
        $model = $this->model->GetToIndex($model);

        $this->ModelView($model);
    }

    public function cadastro($id = 0)
    {
        $model = new \stdClass;
        $model->AplicacaoId = $id;
        $this->loadModel();

        $model = $this->model->GetToEdit($model);

        $this->ModelView($model);
    }

    public function cadastro_post($model = null)
    {
        $this->loadModel();
        echo "<pre>";
        print_r($model);
        echo "</pre>";
    }

    public function deletar($id){
        if($id > 0){
            $this->loadModel();
            $this->model->Deletar($id);
        }

        $this->Redirect("Index");
    }
}
