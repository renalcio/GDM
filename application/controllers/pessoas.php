<?php

/**
 * Class Pessoas
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Controllers;
use Core\Controller;
class Pessoas extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        $this->loadModel();
        $Model = new \stdClass();
        $Model = $this->model->GetToIndex($Model);
        $this->ModelView($Model);
    }


    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function cadastro($id = 0)
    {
        // load views
        $this->loadModel();
        $Model = new \stdClass();
        $Model->PessoaId = $id;
        $Model = $this->model->GetToEdit($Model);
        $this->ModelView($Model);

    }
}