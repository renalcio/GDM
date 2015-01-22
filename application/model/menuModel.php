<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
class MenuModel
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

    
    public function GetMenu($Pai = 0, $AplicacaoId = APPID){
        $retorno = $this->pdo->select("SELECT * FROM Menu 
                                        WHERE AplicacaoId='".$AplicacaoId."'
                                        AND Pai = '".$Pai."'
                                        ORDER BY Posicao ASC", "", true);
        
        if(is_array($retorno) && count($retorno) > 0)
        {
            for($i = 0; $i < count($retorno); $i++)
            {
                $retorno[$i]->ListSubMenu = $this->GetMenu($retorno[$i]->MenuId, $AplicacaoId);
            }
        }
                                       
        return $retorno;
    }
    
    public function Save($model, $Pai = 0, $App = APP_ID)
    {
        if(is_array($model))
        {
            $i = 0;
            foreach($model as $menuItem) {
                $Item = new \stdClass;

                //echo "<br>MenuItem <br>";
                //print_r($menuItem);

                $menuItem = is_object($menuItem) || !is_array($menuItem) ? (Array)$menuItem : $menuItem;


                //echo "<br>MenuItem Convertido <br>";
                print_r($menuItem["apagar"]);

                if(!isset($menuItem["apagar"]) || $menuItem["apagar"] == "0" || $menuItem["apagar"] == 0) {
                    //Inserir ou Atualizar
                    $Item->MenuId = $menuItem["menuid"];
                    $Item->Titulo = $menuItem["titulo"];
                    $Item->Url = $menuItem["url"];
                    $Item->Icone = $menuItem["icone"];
                    $Item->Pai = $Pai;
                    $Item->Posicao = $i;
                    $Item->AplicacaoId = $App;

                    //print_r($Item);
                    //echo "<br>\n\r";

                    if (empty($Item->MenuId)) {
                        $Item->MenuId = $this->pdo->insert("Menu", (Array)$Item);
                    } else {
                        $this->pdo->update("Menu", (Array)$Item, "MenuId='" . $Item->MenuId . "'");
                    }


                    if (isset($menuItem["children"])) {
                        $this->Save($menuItem["children"], $Item->MenuId, $App);
                    }
                    $i++;
                }else{
                    //Apagar Item e Subitens
                    if(isset($menuItem["menuid"]) && !empty($menuItem["menuid"])){
                        //Busca Filhos
                        $filhos = $this->pdo->select("SELECT * FROM Menu WHERE Pai = '".$menuItem["menuid"]."' AND AplicacaoId = '".$App."'", "",
                            true);

                        //Apaga Filhos
                        if(count($filhos) > 0){
                            foreach($filhos as $filho){
                                //Apaga Permissões do filho
                                $this->pdo->delete("Permissao", "MenuId='".$filho->MenuId."' AND AplicacaoId = '".$App."'", 0);
                            }
                        }
                        //Exclui Permissões do Principal
                        $this->pdo->delete("Permissao", "MenuId='".$menuItem["menuid"]."' AND AplicacaoId = '".$App."'", 0);

                        //Exclui principal
                        $this->pdo->delete("Menu", "MenuId = '".$menuItem["menuid"]."' OR Pai = '".$menuItem["menuid"]
                            ."' AND AplicacaoId = '".$App."'");
                    }
                }

            }
        }
        
    }
    
    public function LimpaMenu($AplicacaoId = APPID){
        //if(defined(APP_ID))
            $this->pdo->delete("Menu", "AplicacaoId = '".$AplicacaoId."'", 0);
    }
}
