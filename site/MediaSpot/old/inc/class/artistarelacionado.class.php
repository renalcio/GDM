<?php

include_once ("mysql.class.php");
class ArtistaRelacionado
{
    var $ArtistaRelacionadoId;
    var $ArtistaId;
    var $Titulo; 

    public function __construct($ArtistaRelacionadoId="", $ArtistaId="", $Titulo="")
    {
        $mysqlf = new MysqlHelper;
        $this->ArtistaRelacionadoId = $ArtistaRelacionadoId;
        $this->ArtistaId = $ArtistaId;
        $this->Titulo = mysql_real_escape_string($Titulo, $mysqlf->getLink()) ;
    }
    
    function decode(){
        $this->Titulo = stripslashes($this->Titulo);
        return $this;
    }

    function Salvar($ArtistaRelacionadoId="", $ArtistaId="", $Titulo="")
    {
        $mysqlf = new MysqlHelper;
        
        $this->ArtistaRelacionadoId = !empty($ArtistaRelacionadoId) ? $ArtistaRelacionadoId : $this->ArtistaRelacionadoId;
        $this->ArtistaId = !empty($ArtistaId) ? $ArtistaId : $this->ArtistaId;
        $this->Titulo = !empty($Titulo) ? mysql_real_escape_string($Titulo, $mysqlf->getLink()) : $this->Titulo;
        
        if($this->ArtistaRelacionadoId > 0)
            $sqlmy = $mysqlf->query("UPDATE ArtistaRelacionado SET ArtistaId = '{$this->ArtistaId}', Tags = LOWER('{$this->Titulo}') WHERE ArtistaRelacionadoId='{$this->ArtistaRelacionadoId}'");
        else
            $sqlmy = $mysqlf->query("INSERT INTO ArtistaRelacionado (ArtistaId,Titulo) VALUES ('{$this->ArtistaId}', LOWER('{$this->Titulo}'))");
        
        $sqlGet = $mysqlf->query("SELECT * FROM ArtistaRelacionado WHERE ArtistaRelacionadoId=(select MAX(ArtistaRelacionadoId) from ArtistaRelacionado)");
        
        $ArtistaRelacionado = $mysqlf->associar($sqlGet);
            
        $this->ArtistaRelacionadoId = $ArtistaRelacionado["ArtistaRelacionadoId"]; 
        
        return $this;
    }

    function Excluir($ArtistaRelacionadoId)
    {
        $mysqlf = new MysqlHelper;
        
        $this->ArtistaRelacionadoId = !empty($ArtistaRelacionadoId) ? $ArtistaRelacionadoId : $this->ArtistaRelacionadoId;
        
        $sqlmy = $mysqlf->query("DELETE FROM ArtistaRelacionado WHERE ArtistaRelacionadoId='{$this->ArtistaRelacionadoId}'");
    }
}

?>