<?php
namespace BLL;
use DAL\Menu;
use DAL\Permissao;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
class MenuBLL extends BLL
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
    }

    
    public function GetMenu($Pai = 0, $AplicacaoId = APPID){
        $retorno = $this->unitofwork->Get(new Menu(), "AplicacaoId='".$AplicacaoId."' AND Pai = '".$Pai."'")->OrderBy("Posicao")->ToArray();
        
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
                    $Item = new Menu();
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
                        $this->unitofwork->Insert($Item);
                    } else {
                        $this->unitofwork->Update($Item);
                    }


                    if (isset($menuItem["children"])) {
                        $this->Save($menuItem["children"], $Item->MenuId, $App);
                    }
                    $i++;
                }else{
                    //Apagar Item e Subitens
                    if(isset($menuItem["menuid"]) && !empty($menuItem["menuid"])){
                        //Busca Filhos
                        $filhos = $this->unitofwork->Get(new Menu(), "Pai = '".$menuItem["menuid"]."' AND AplicacaoId = '".$App."'")->ToArray();

                        //Apaga Filhos
                        if(count($filhos) > 0){
                            foreach($filhos as $filho){
                                //Apaga Permissões do filho
                                $this->unitofwork->Delete(new Permissao(), "MenuId='".$filho->MenuId."' AND AplicacaoId = '".$App."'");
                            }
                        }
                        //Exclui Permissões do Principal
                        $this->unitofwork->Delete(new Permissao(), "MenuId='".$menuItem["menuid"]."' AND AplicacaoId = '".$App."'");

                        //Exclui principal
                        $this->unitofwork->Delete(new Menu(), "MenuId = '".$menuItem["menuid"]."' OR Pai = '".$menuItem["menuid"]."' AND AplicacaoId = '".$App."'");
                    }
                }

            }
        }
        
    }
    
    public function LimpaMenu($AplicacaoId = APPID){
        //if(defined(APP_ID))
            $this->unitofwork->Delete(new Menu(), "AplicacaoId = '".$AplicacaoId."'");
    }
}
