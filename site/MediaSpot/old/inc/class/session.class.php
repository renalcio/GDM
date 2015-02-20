<?php
class SessionHelper{
    // Coloque aqui as Informações do Banco de Dados
    var $id; #id da sessão
    var $nome; # Nome da sessão
    var $campo; # Campo da sessão
    var $valor; # Valor da sessão
    var $cookie; #cookie para resgate
    var $retorno;
    
    function definir($nome, $campo, $valor){
        //Popula campos atuais
        if($nome=="usuario"){
            $this->nome = "usr";
        }else{
            $this->nome = $nome;
        }
        $this->campo = $campo;
        $this->valor = $valor;
        //Verifica sessão atual
        if (!$_SESSION || !isset($_SESSION)) @ session_start();
        
        //define sessão
        $_SESSION[$this->nome][$this->campo] = $this->valor;
        
        //verifica se foi preenchido
        if(isset($_SESSION[$this->nome][$this->campo])){
            //retorna VERDADEIRO
            return true;
        }else{
            // se não foi definido apaga o session
            unset($_SESSION[$this->nome][$this->campo]);
            // retorna falso
            return false;
        }
        
    }
    
    function destruir($nome, $campo="", $funcDestruir = true){
         //Popula campos atuais
        if($nome=="usuario"){
            $this->nome = "usr";
        }else{
        $this->nome = $nome;
        }
        $this->campo = $campo;
        if(empty($this->campo)){
            unset($_SESSION[$this->nome]);
            }else{
                unset($_SESSION[$this->nome][$this->campo]);
            }
        if($funcDestruir){
                session_destroy();
            }
            //verifica se há sessão e retorna TRUE : FALSE
            if(isset($_SESSION[$this->nome][$this->campo])){
                return false;
            }else{
                return true;
            }
    }
    
    function ver($nome, $campo=""){
        if($nome=="usuario"){
            $this->nome = "usr";
        }else{
        $this->nome = $nome;
        }
        $this->campo = $campo;
        if(!empty($this->campo)){
            $this->retorno = Array();
            $this->retorno = (isset($_SESSION[$this->nome])) ? (Array)$_SESSION[$this->nome] : null;
            return (isset($this->retorno[$this->campo])) ? $this->retorno[$this->campo] : null;                        
        }else{
            $this->retorno = $_SESSION[$this->nome];
        }
         
    }
    
    function CookieToSession($nome, $cookie, $array = true){
        $this->nome = $nome;
        $this->cookie = $cookie;
        if($array){
      foreach ($_COOKIE[$this->cookie] as $campo => $valor) {
        $_SESSION[$this->nome][$campo] =  $valor;
      }  
      }else{
        $_SESSION[$this->nome] = $_COOKIE[$this->cookie];
      }
    }
}
?>