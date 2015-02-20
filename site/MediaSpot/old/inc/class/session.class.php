<?php
class SessionHelper{
    // Coloque aqui as Informa��es do Banco de Dados
    var $id; #id da sess�o
    var $nome; # Nome da sess�o
    var $campo; # Campo da sess�o
    var $valor; # Valor da sess�o
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
        //Verifica sess�o atual
        if (!$_SESSION || !isset($_SESSION)) @ session_start();
        
        //define sess�o
        $_SESSION[$this->nome][$this->campo] = $this->valor;
        
        //verifica se foi preenchido
        if(isset($_SESSION[$this->nome][$this->campo])){
            //retorna VERDADEIRO
            return true;
        }else{
            // se n�o foi definido apaga o session
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
            //verifica se h� sess�o e retorna TRUE : FALSE
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