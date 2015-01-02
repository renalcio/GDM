<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
class LoginModel
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
        $this->pdo = new Database;
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
            //var_dump($check);
            if(empty($check))
                $retorno[] = Helper::Utf("Login ou senha inválidos");
        }
        
        return $retorno;
    }
    
    public function GetUsuarioByLoginSenha($Login, $Senha)
    {
        $md5Senha = md5($Senha);
        $query = $this->pdo->select("SELECT 
                                            p.Email, 
                                            u.* 
                                            FROM Usuario u, 
                                            Pessoa p 
                                            WHERE 
                                            (p.Email = '$Login' OR u.Login = '$Login')
                                            AND u.Senha = '$md5Senha'
                                            AND u.PessoaId = p.PessoaId");

            return $query;
    }
    
    public function SetLogin($Login, $Senha)
    {
        $Usuario = $this->GetUsuarioByLoginSenha($Login, $Senha);
        if(!empty($Usuario)){
            
            //Set Session e Cookies
            $session = new Session("GDMAuth", Array("UsuarioId" => $Usuario->UsuarioId, "PessoaId" => $Usuario->PessoaId, "AplicacaoId" => $Usuario->AplicacaoId));
            $cookie = new Cookie("GDMAuth", Array("UsuarioId" => $Usuario->UsuarioId, "PessoaId" => $Usuario->PessoaId, "AplicacaoId" => $Usuario->AplicacaoId));
            
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
