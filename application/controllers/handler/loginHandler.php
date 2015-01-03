<?php
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
use Libs\Helper;

class LoginHandler extends Controller
{
    function Auth($Login, $Senha)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        //extract($_POST);
        $this->loadModel();
        $retorno = new \stdClass;
        $retorno->Status = false;
        $retorno->Erros = Array();


        //VALIDACAO DE DADOS
        $validacao = Array();
        //extract($post);
        if(empty($Login))
            $validacao[] = Helper::Utf("Login em branco");
        if(empty($Senha))
            $validacao[] = Helper::Utf("Senha em branco");

        //Verifica Login e Senha
        if(count($validacao) == 0){
            $md5Senha = md5($Senha);
            $check = $this->pdo->select("SELECT
                                            p.Email,
                                            u.*
                                            FROM Usuario u,
                                            Pessoa p
                                            WHERE
                                            (p.Email = '$Login' OR u.Login = '$Login')
                                            AND u.Senha = '$md5Senha'
                                            AND u.PessoaId = p.PessoaId");
            var_dump($check);
            if(empty($check))
                $validacao[] = Helper::Utf("Login ou senha inválidos");
        }


        if(count($validacao) > 0)
        {
            $retorno->Erros = $validacao;

        }else{
            $retorno->Status = true;
            $retorno->Usuario = $check;

            //SET COOKIES
            //Set Session e Cookies
            $session = new Session("GDMAuth", Array("UsuarioId" => $check->UsuarioId, "PessoaId" => $check->PessoaId, "AplicacaoId" => $check->AplicacaoId));
            $cookie = new Cookie("GDMAuth", Array("UsuarioId" => $check->UsuarioId, "PessoaId" => $check->PessoaId, "AplicacaoId" => $check->AplicacaoId));

            //Cookie
            //$cookie->Definir("UsuarioId", $Usuario->UsuarioId);
            //$cookie->Definir("PessoaId", $Usuario->PessoaId);
        }
        echo json_encode($retorno);
    }
}
?>