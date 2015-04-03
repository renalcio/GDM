<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;
use \Libs\CookieHelper;
use \Libs\SessionHelper;
use Libs\UsuarioHelper;

class LoginController extends Controller
{
    /**
     * @Public
     * @Generic
     */
    public function index()
    {
        $this->View("index", "login", "Header.Login", "Footer.Login");
    }

    /**
     * @Public
     * @Generic
     */
    public function auth()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        //echo "Auth";
        extract($_REQUEST);
            $this->loadBLL();
            $retorno = new \stdClass;
            $retorno->Status = false;
            $retorno->Erros = Array();
            
            $validacao = $this->bll->VerificaDados($_POST);
            if(count($validacao) > 0)
            {
                $retorno->Erros = $validacao;
                
            }else{
                $retorno->Status = true;
                $retorno->Usuario = $this->bll->GetUsuarioByLoginSenha($Login, $Senha);
                
                $this->bll->SetLogin($Login, $Senha);
            }
            echo json_encode($retorno);
    }

    /**
     * @Public
     * @Generic
     */
    public function Logout(){
        \Libs\SessionHelper::Deletar("GDMAuth");
        \Libs\CookieHelper::Deletar("GDMAuth");

        session_destroy();

        $this->Redirect("index");
    }

    /**
     * @Public
     * @Generic
     */
    public function SelecionaAplicacao($id = ""){
        if(empty($id)) {
            $model = UsuarioHelper::getAplicacoes();
            if (count($model) > 0)
                $this->ModelView($model, "selecionaAplicacao", "login", "Header.Login", "Footer.Login");
            else
                $this->Redirect("logout");

            //var_dump($model);
        }else{
            UsuarioHelper::setAplicacao($id);

            $this->Redirect("index", "home");
        }
    }
}
