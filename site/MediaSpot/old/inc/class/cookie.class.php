<?php
class CookieHelper{
    // Coloque aqui as Informações do Banco de Dados
    var $nome; # Nome do cookie
    var $campo; # Campo do cookie
    var $valor; # Valor do cookie
    var $resgate; #cookie para resgate
    var $path;
    var $tempo;
    
    function definir($nome, $campo, $valor, $path='/', $tempo='365'){
        //Popula campos atuais
        $this->nome = $nome;
        $this->campo = $campo;
        $this->valor = $valor;
        $this->path = $path;
        $this->tempo = strtotime('+'.$tempo.' days');
        //verifica se o cookie existe ou não
        if(isset($_COOKIE[$this->nome])){
            //adiciona/altera campo se existe
            $_COOKIE[$this->nome][$this->campo] = $this->valor;
        }else{
            //cria e adiciona campo e valor se não existe
             setcookie($this->nome, true);
            setcookie($this->nome."[".$this->campo."]", $this->valor,$this->tempo, $this->path);
            $_COOKIE[$this->nome][$this->campo] = $this->valor;
        }
        //verifica se foi criado e retorna TRUE : FALSE
        if(isset($_COOKIE[$this->nome][$this->campo])){
            return true;
        }else{
            unset($_COOKIE[$this->nome][$this->campo]);
            setcookie($this->nome."[".$this->campo."]");
            return false;
        }
    }
    
    function destruir($nome, $campo="", $funcDestruir = true){
         //Popula campos atuais
        $this->nome = $nome;
        $this->campo = $campo;
        if(empty($this->campo)){
            unset($_COOKIE[$this->nome]);
            setcookie($this->nome);
        }else{
            setcookie($this->nome."[".$this->campo."]");
        }
            //verifica se há sessão e retorna TRUE : FALSE
            if(isset($_COOKIE[$this->nome][$this->campo])){
                return false;
            }else{
                return true;
            }
    }
    
    function serializar($nome, $campo, $valor, $path='/', $tempo='365'){
        //Popula campos atuais
        $this->nome = $nome;
        $this->campo = $campo;
        $this->valor = serialize($valor);
        $this->path = $path;
        $this->tempo = strtotime('+'.$tempo.' days');
        //verifica se o cookie existe ou não
        if(isset($_COOKIE[$this->nome])){
            //adiciona/altera campo se existe
            $_COOKIE[$this->nome][$this->campo] = $this->valor;
        }else{
            //cria e adiciona campo e valor se não existe
             setcookie($this->nome, true);
             setcookie($this->nome."[".$this->campo."]", $this->valor,$this->tempo, $this->path);
            $_COOKIE[$this->nome][$this->campo] = $this->valor;
        }
        //verifica se foi criado e retorna TRUE : FALSE
        if(isset($_COOKIE[$this->nome][$this->campo])){
            return true;
        }else{
            unset($_COOKIE[$this->nome][$this->campo]);
            setcookie($this->nome."[".$this->campo."]");
            return false;
        }
    }
    
    function ver($nome, $campo="", $serializado=false){
        $this->nome = $nome;
        $this->campo = $campo;
        if($serializado==true){
            if(!empty($this->campo)){
                return unserialize($_COOKIE[$this->nome][$this->campo]);
            }else{
                return unserialize($_COOKIE[$this->nome]);
            }
        }else{
            if(!empty($this->campo)){
                return $_COOKIE[$this->nome][$this->campo];
            }else{
                return $_COOKIE[$this->nome];
            }
        }
    }
}
?>