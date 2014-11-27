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
class Login extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $this->View("index", "login", "header_login");
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function auth()
    {
       
        extract($_POST);
        
       
            $this->loadModel();            
            header('Content-Type: application/json; Charset=UTF-8');
            $retorno = new \stdClass;
            $retorno->Status = false;
            $retorno->Erros = Array();
            
            $validacao = $this->model->VerificaDados($_POST);
            if(count($validacao) > 0)
            {
                $retorno->Erros = $validacao;
                
            }else{
                $retorno->Status = true;
                $retorno->Usuario = $this->model->GetUsuarioByLoginSenha($Login, $Senha);
                
                $this->model->SetLogin($Login, $Senha);
            }
            echo json_encode($retorno);
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function exampleTwo()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/home/example_two.php';
        require APP . 'views/_templates/footer.php';
    }
}
