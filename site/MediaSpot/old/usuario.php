<?
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: text/html; charset=UTF-8');
include_once ("inc/config.php");

extract($_POST);

$a = $_GET["a"] ? $_GET["a"] : $_POST["a"];

if($a == "cadastro"){
    if(!empty($nome) && !empty($login) && !empty($senha) && !empty($email)){
        $Usuario = new stdClass;
        $Usuario->Nome = $nome;
        $Usuario->Login = $login;
        $Usuario->Senha = md5($senha);
        $Usuario->Email = $email;
        $Usuario->Ativo = 1;
        //Validar
        $Retorno = new stdClass;
        $Retorno->Status = true;
        
        //Login
        $validar = $pdo->select("SELECT * FROM Usuario WHERE
                                LOWER(Login) = '".strtolower($login)."'
                                AND Ativo = 1");
        if(count($validar) > 0){
            $Retorno->Erros[] = new Erro(1, "Este login já esté em uso");
            $Retorno->Status = false;
        }
        
        //Email
        $validar = $pdo->select("SELECT * FROM Usuario WHERE
                                LOWER(Email) = '".strtolower($email)."'
                                AND Ativo = 1");
        if(count($validar) > 0){
            $Retorno->Erros[] = new Erro(2, "Este email já esté em uso");
            $Retorno->Status = false;
        }
        
        if($Retorno->Status == true){
            $Usuario->UsuarioId = $pdo->insert("Usuario", (Array)$Usuario);
        }
        
        $Retorno->Usuario = $Usuario;
        
        echo json_encode($Retorno);
        
    }else{
        //Dados incorretos
        $Retorno = new stdClass;
        $Retorno->Status = false;
        $Retorno->Erros[] = new Erro(3, "Dados insuficientes");
        
        echo json_encode($Retorno);
    }
}
if($a == "login"){
    if(!empty($login) && !empty($senha)){
        
        $md5Senha = md5($senha);
        
       //Validar
        $Retorno = new stdClass;
        $Retorno->Status = true;
        
        //Login
        $validar = $pdo->select("SELECT * FROM Usuario WHERE
                                LOWER(Login) = '".strtolower($login)."' AND Senha = '".$md5Senha."'
                                AND Ativo = 1");
        if(count($validar) > 0){
            $Retorno->Usuario = $validar[0];
            //Inicia Session
            session_destroy();
            
            $session->definir("Usuario", "UsuarioId", $validar[0]->UsuarioId);
            $session->definir("Usuario", "Nome", $validar[0]->Nome);
            $session->definir("Usuario", "Email", $validar[0]->Email);
        }else{
            $Retorno->Status = false;
            $Retorno->Erros[] = new Erro(4, "Login ou senha incorretos");
        }
        
        echo json_encode($Retorno);
        
        }else{
        //Dados incorretos
        $Retorno = new stdClass;
        $Retorno->Status = false;
        $Retorno->Erros[] = new Erro(3, "Dados insuficientes");
        
        echo json_encode($Retorno);
    }
}
if($a == "logout"){
    session_destroy();
    $Retorno = new stdClass;
    $Retorno->Status = true;
}
?>