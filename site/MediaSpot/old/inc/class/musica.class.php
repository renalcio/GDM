<?php

include_once ("mysql.class.php");
class Musica
{
    var $MusicaId;
    var $ArtistaId; 
    var $Titulo; 
    var $Pagina; 


    function __construct($MusicaId=0, $ArtistaId=0, $Titulo="", $Pagina="1")
    {
        $mysqlf = new MysqlHelper;
        $this->MusicaId = $MusicaId;
        $this->ArtistaId = $ArtistaId;
        $this->Titulo = mysql_real_escape_string($Titulo, $mysqlf->getLink());
        $this->Pagina = $Pagina;
    }
    
    function decode(){
        $this->Titulo = stripslashes($this->Titulo);
        return $this;
    }

    function Salvar($MusicaId=0, $ArtistaId=0, $Titulo="", $Pagina="")
    {
        $mysqlf = new MysqlHelper;
            $this->ArtistaId = !empty($ArtistaId) ? $ArtistaId : $this->ArtistaId;
            $this->Titulo = !empty($Titulo) ? mysql_real_escape_string($Titulo, $mysqlf->getLink()) : $this->Titulo;
            $this->Pagina = !empty($Pagina) ? $Pagina : $this->Pagina;
            $this->MusicaId = !empty($MusicaId) ? $MusicaId : $this->MusicaId;
            
          /*  echo "<Br><Br>Musicas<br><pre>";
                    print_r($this);
                    echo "--<pre>";
                    echo "<br><br><br>";*/
            
            
            if($this->MusicaId > 0){
                $mysqlf->query("UPDATE Musica SET ArtistaId = '".$this->ArtistaId."', Titulo = '".$this->Titulo."', Pagina = '".$this->Pagina."' WHERE MusicaId = '".$this->MusicaId."'");
            }else{
                
                $sqlBusca = $mysqlf->query("SELECT * FROM Musica WHERE Titulo = '".$this->Titulo."' AND ArtistaId = '".$this->ArtistaId."'");
                $sqlResultado = $mysqlf->associar($sqlBusca);
                
                if($sqlResultado["MusicaId"] > 0){
                    
                }else{
                $mysqlf->query("INSERT INTO Musica (ArtistaId, Titulo, Pagina) VALUES ('".$this->ArtistaId."', '".$this->Titulo."', '".$this->Pagina."')");
                }
            }
        
        $sqlGet = $mysqlf->query("SELECT * FROM Musica WHERE MusicaId=(select MAX(MusicaId) from Musica)");
        $Musica = $mysqlf->associar($sqlGet);
            
        $this->MusicaId = $Musica["MusicaId"]; 
        
        return $this;
    }
    
    
    function Excluir($MusicaId=""){
        $mysqlf = new MysqlHelper;
        
            $this->MusicaId = !empty($MusicaId) ? $MusicaId : $this->MusicaId;
            
        $mysqlf->query("DELETE FROM Musica WHERE MusicaId = '".$this->MusicaId."'");
            
    }
}

?>