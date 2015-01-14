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
use \Libs\Cookie;
use \Libs\Session;
use Libs\Usuario;

class LoginController extends Controller
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
        header('Content-Type: application/json; Charset=UTF-8');
        //echo "Auth";
        extract($_POST);
            $this->loadModel();
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

    public function Logout(){
        \Libs\Session::Deletar("GDMAuth");
        \Libs\Cookie::Deletar("GDMAuth");

        session_destroy();

        $this->Redirect("index");
    }

    public function SelecionaAplicacao($id = ""){
        if(empty($id)) {
            $model = Usuario::getAplicacoes();
            if (count($model) > 0)
                $this->ModelView($model, "selecionaAplicacao", "login", "header_login");
            else
                $this->Redirect("logout");

        }else{
            Usuario::setAplicacao($id);

            $this->Redirect("index", "home");
        }
    }
}
