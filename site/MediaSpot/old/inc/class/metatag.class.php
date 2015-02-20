<?php

include_once ("mysql.class.php");
class Metatag
{
    var $MetatagId;
    var $ArtistaId;
    var $Tags; 

    public function __construct($MetatagId="", $ArtistaId="", $Tags="")
    {
        $mysqlf = new MysqlHelper;
        $this->MetatagId = $MetatagId;
        $this->ArtistaId = $ArtistaId;
        $this->Tags = mysql_real_escape_string($Tags, $mysqlf->getLink()) ;
    }
    
    function decode(){
        $this->Tags = stripslashes($this->Tags);
        return $this;
    }

    function Salvar($MetatagId="", $ArtistaId="", $Tags="")
    {
        $mysqlf = new MysqlHelper;
        
        $this->MetatagId = !empty($MetatagId) ? $MetatagId : $this->MetatagId;
        $this->ArtistaId = !empty($ArtistaId) ? $ArtistaId : $this->ArtistaId;
        $this->Tags = !empty($Tags) ? mysql_real_escape_string($Tags, $mysqlf->getLink()) : $this->Tags;
        
        if($this->MetatagId > 0)
            $sqlmy = $mysqlf->query("UPDATE Metatag SET ArtistaId = '{$this->ArtistaId}', Tags = LOWER('{$this->Tags}') WHERE MetatagId='{$this->MetatagId}'");
        else
            $sqlmy = $mysqlf->query("INSERT INTO Metatag (ArtistaId,Tags) VALUES ('{$this->ArtistaId}', LOWER('{$this->Tags}'))");
        
        $sqlGet = $mysqlf->query("SELECT * FROM Metatag WHERE MetatagId=(select MAX(MetatagId) from Metatag)");
        $Metatag = $mysqlf->associar($sqlGet);
            
        $this->MetatagId = $Metatag["MetatagId"]; 
        
        return $this;
    }

    function Excluir($MetatagId)
    {
        $mysqlf = new MysqlHelper;
        
        $this->MetatagId = !empty($MetatagId) ? $MetatagId : $this->MetatagId;
        
        $sqlmy = $mysqlf->query("DELETE FROM Metatag WHERE MetatagId='{$this->MetatagId}'");
    }
}

?>