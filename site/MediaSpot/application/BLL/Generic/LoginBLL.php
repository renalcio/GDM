<?php
namespace BLL;
use DAL\Aplicacao;
use DAL\Pessoa;
use DAL\Usuario;
use DAL\UsuarioAplicacao;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use Libs\UnitofWork;

class LoginBLL extends BLL
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function VerificaDados(Array $post)
    {
        $retorno = Array();
        extract($post);
        if(empty($Login))
            $retorno[] = Helper::Utf("Login em branco");
        if(empty($Senha))
            $retorno[] = Helper::Utf("Senha em branco");

        //Verifica Login e Senha
        if(count($retorno) == 0){
            $md5Senha = md5($Senha);
            $check = $this->GetUsuarioByLoginSenha($Login, $Senha);
            // var_dump($check);
            if(empty($check))
                $retorno[] = "Login ou senha inválidos";
        }

        return $retorno;
    }

    public function GetUsuarioByLoginSenha($Login, $Senha)
    {
        $md5Senha = md5($Senha);
        $this->unitofwork = new UnitofWork();
        $query = $this->unitofwork->Get(new Usuario(), "u.Senha = '".$md5Senha."'")->Join($this->unitofwork->Get(new Pessoa(), "p.Email = '$Login' OR u.Login = '$Login'"),"u.PessoaId","p.PessoaId")->Select("p.Email, u.*")->First();
        if($query != null) {
            $aplicacoes = $this->unitofwork->Get(new UsuarioAplicacao(), "Ativo = '1' AND UsuarioId = '" . $query->UsuarioId."'")->ToArray();

            if (count($aplicacoes) > 0) {
                if (count($aplicacoes) > 1) {
                    //Mais de uma
                    $query->AplicacaoId = 0;
                } else {
                    $query->AplicacaoId = $aplicacoes[0]->AplicacaoId;
                }
            }else{
                $query = null;
            }
        }
        return $query;
    }

    public function SetLogin($Login, $Senha)
    {
        $Usuario = $this->GetUsuarioByLoginSenha($Login, $Senha);
        $Pasta = "";
        if(!empty($Usuario)){

            $aplicacoes = $this->unitofwork->Get(new UsuarioAplicacao(), "Ativo = '1' AND UsuarioId = '".$Usuario->UsuarioId."'")->ToArray();

            if(count($aplicacoes) > 0){
                if(count($aplicacoes) > 1){
                    //Mais de uma
                    $Usuario->AplicacaoId = 0;
                }else{
                    $Usuario->AplicacaoId = $aplicacoes[0]->AplicacaoId;
                    $Aplicacao = $this->unitofwork->GetById(new Aplicacao(), $Usuario->AplicacaoId);
                    $Pasta = $Aplicacao->Pasta;
                }
                //Set Session e Cookies
                $session = new SessionHelper("GDMAuth", Array(
                        "UsuarioId" => $Usuario->UsuarioId,
                        "PessoaId" => $Usuario->PessoaId,
                        "AplicacaoId" => $Usuario->AplicacaoId,
                        "Pasta" => $Pasta
                    )
                );

                $cookie = new CookieHelper("GDMAuth", Array(
                        "UsuarioId" => $Usuario->UsuarioId,
                        "PessoaId" => $Usuario->PessoaId,
                        "AplicacaoId" => $Usuario->AplicacaoId,
                        "Pasta" => $Pasta
                    )
                );
            }



            //Cookie
            //$cookie->Definir("UsuarioId", $Usuario->UsuarioId);
            //$cookie->Definir("PessoaId", $Usuario->PessoaId);



            return true;
        }else
        {
            return false;
        }
    }
}
