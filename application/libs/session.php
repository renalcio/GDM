<?php 
namespace Libs;
class Session
{
    public $Titulo; #Titulo do Cookie
    public $Valores; #Array - Valores do Cookie
    
    public function __construct($Titulo, $Valores = null)
    {
        
        $this->Titulo = $Titulo;
       
        
        
        if(!isset($_SESSION))
            session_start();
            
        $val = is_array($Valores) ? serialize($Valores) : true;
        
        if(isset($_SESSION[$Titulo]))
        {
            $check = @unserialize($_SESSION[$Titulo]);
            if($check !== FALSE)
            {
                $this->Valores = unserialize($_SESSION[$Titulo]);
            }
            else
            {
                if(is_array($Valores))
                    $_SESSION[$Titulo] = $val;
            }
        }
        else
        {  
            $_SESSION[$Titulo] = $val;
            $this->Valores = is_array($Valores) ? $Valores : Array();
        }
        
        return $this;
    }
    
    public function Definir($Campo, $Valor)
    {
        //Busca o cookie
        $session = $_SESSION[$this->Titulo];
        
        //Pega todos os valores
        $this->Valores = @unserialize($session) !== FALSE ? unserialize($session) : Array();
        
        //Seta o valor indicado
        $this->Valores[$Campo] = $Valor;
        
        //Serializa
        $serializado = serialize($this->Valores);
        
        //Salva
        $_SESSION[$this->Titulo] = $serializado;
        
        return $this;
    }
    
    public function Ver($Campo)
    {
        $session = $_SESSION[$this->Titulo];
        
        $this->Valores = @unserialize($session) !== FALSE ? unserialize($session) : Array();
        if(isset($this->Valores[$Campo]))
            return $this->Valores[$Campo];
        else
            return null;
    }
    
    public function Verifica($Campo){
        
        if(!empty($_SESSION[$this->Titulo])){
            
            $session = $_SESSION[$this->Titulo];
            $check = @unserialize($session);
            if($check !== FALSE)
            {
                $this->Valores = unserialize($session);
                if(isset($this->Valores[$Campo]))
                    return true;
                else
                    return false;
            }
            else
                return false;            
        }
        else
            return false;
    }
    
    public static function VerificaSimples($Titulo){
        if(isset($_SESSION[$Titulo]))
            return true;
        else
            return false;
    }
    
    public static function DefinirSimples($Titulo, $Valor)
    {
         if(!isset($_SESSION))
            session_start();
            
        $_SESSION[$Titulo] = $Valor;
    }
    
    public static function VerSimples($Titulo){
        return $_SESSION[$Titulo];
    }

    public static function Deletar($Titulo, $Campo = ""){

        if(!isset($_SESSION))
            session_start();

        if(isset($_SESSION[$Titulo])) {

            if (empty($Campo)) {

                $_SESSION[$Titulo] = "";
                unset($_SESSION[$Titulo]);

            } else {
                //Pega Session
                $session = $_SESSION[$Titulo];

                //Serializa
                $valores = @unserialize($session) !== FALSE ? unserialize($session) : Array();

                //Verifica campo
                if (isset($valores[$Campo])) {

                    //Apaga valor desejado
                    $valores[$Campo] = "";
                    unset($valores[$Campo]);

                    //Serializa
                    $serializado = serialize($valores);

                    //Salva
                    $_SESSION[$Titulo] = $serializado;
                }

            }
        }

    }
}