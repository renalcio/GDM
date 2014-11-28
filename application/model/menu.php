<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
class Menu
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

    
    public function GetMenu($Pai = 0){
        $retorno = $this->pdo->select("SELECT * FROM Menu 
                                        WHERE AplicacaoId='".APP_ID."'
                                        AND Pai = '$Pai'
                                        ORDER BY Posicao ASC");
        
        if(is_array($retorno) && count($retorno) > 0)
        {
            for($i = 0; $i < count($retorno); $i++)
            {
                $retorno[$i]->ListSubMenu = $this->GetMenu($retorno[$i]->MenuId);
            }
        }
                                       
        return $retorno;
    }
    
    public function Save($model, $Pai = 0){
        
        if(is_array($model))
        {
            $i = 0;
            foreach($model as $menuItem){
                $Item = new \stdClass;
                
                //echo "<br>MenuItem <br>";
                //print_r($menuItem);
                
                $menuItem = is_object($menuItem) || !is_array($menuItem) ? (Array)$menuItem : $menuItem;
                
                
                //echo "<br>MenuItem Convertido <br>";
                //print_r($menuItem);
                
                //$Item->MenuId = $menuItem["menuid"];
                $Item->Titulo = $menuItem["titulo"];
                $Item->Url = $menuItem["url"];
                $Item->Icone = $menuItem["icone"];
                $Item->Pai = $Pai;
                $Item->Posicao = $i;
                $Item->AplicacaoId = APP_ID;
                
                //print_r($Item);
                //echo "<br>\n\r";
                
                $PaiId = $this->pdo->insert("Menu", (Array)$Item);
                
                
                if(isset($menuItem["children"]))
                {
                    $this->Save($menuItem["children"], $PaiId);  
                }
                $i++;
            }
        }
        
    }
    
    public function LimpaMenu(){
        //if(defined(APP_ID))
            $this->pdo->delete("Menu", "AplicacaoId = ".APP_ID, 0);
    }
}
