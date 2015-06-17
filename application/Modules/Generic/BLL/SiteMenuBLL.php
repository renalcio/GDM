<?php
namespace Modules\Generic\BLL;
use Core\BLL;
use Model\SiteMenu;
use Model\Permissao;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
class SiteMenuBLL extends BLL
{
    public function GetSiteMenu($Pai = 0, $AplicacaoId = APPID){
        $retorno = $this->unitofwork->Get(new SiteMenu(), "AplicacaoId='".$AplicacaoId."' AND Pai = '".$Pai."'")->OrderBy("Posicao")->ToArray();
        
        if(is_array($retorno) && count($retorno) > 0)
        {
            for($i = 0; $i < count($retorno); $i++)
            {
                $retorno[$i]->ListSubSiteMenu = $this->GetSiteMenu($retorno[$i]->SiteMenuId, $AplicacaoId);
            }
        }
                                       
        return $retorno;
    }
    
    public function Save($model, $Pai = 0, $App = APP_ID)
    {
        //print_r($model);
        if(is_array($model))
        {
            $i = 0;
            foreach($model as $SiteMenuItem) {
                //$Item = new \stdClass;
                $Item = new SiteMenu();
                //echo "<br>SiteMenuItem <br>";
                //print_r($SiteMenuItem);

                $SiteMenuItem = is_object($SiteMenuItem) || !is_array($SiteMenuItem) ? (Array)$SiteMenuItem : $SiteMenuItem;


                //echo "<br>SiteMenuItem Convertido <br>";
                //print_r($SiteMenuItem["apagar"]);

                if(!isset($SiteMenuItem["apagar"]) || $SiteMenuItem["apagar"] == "0" || $SiteMenuItem["apagar"] == 0) {
                    //Inserir ou Atualizar

                    $Item->SiteMenuId = $SiteMenuItem["sitemenuid"];
                    $Item->Titulo = $SiteMenuItem["titulo"];
                    $Item->Url = $SiteMenuItem["url"];
                    $Item->Icone = $SiteMenuItem["icone"];
                    $Item->Pai = $Pai;
                    $Item->Posicao = $i;
                    $Item->AplicacaoId = $App;

                   //print_r($Item);
                    //echo "<br>\n\r";

                    if (empty($Item->SiteMenuId)) {
                        $this->unitofwork->Insert($Item);
                    } else {
                        $this->unitofwork->Update($Item);
                    }


                    if (isset($SiteMenuItem["children"])) {
                        $this->Save($SiteMenuItem["children"], $Item->SiteMenuId, $App);
                    }
                    $i++;
                }else{
                    //Apagar Item e Subitens
                    if(isset($SiteMenuItem["sitemenuid"]) && !empty($SiteMenuItem["sitemenuid"])){
                        //Busca Filhos
                        $filhos = $this->unitofwork->Get(new SiteMenu(), "Pai = '".$SiteMenuItem["sitemenuid"]."' AND AplicacaoId = '".$App."'")->ToArray();

                        //Apaga Filhos
                        if(count($filhos) > 0){
                            foreach($filhos as $filho){
                                //Apaga Permissões do filho
                                $this->unitofwork->Delete(new Permissao(), "SiteMenuId='".$filho->SiteMenuId."' AND AplicacaoId = '".$App."'");
                            }
                        }

                        //Exclui principal
                        $this->unitofwork->Delete(new SiteMenu(), "SiteMenuId = '".$SiteMenuItem["sitemenuid"]."' OR Pai = '".$SiteMenuItem["sitemenuid"]."' AND AplicacaoId = '".$App."'");
                    }
                }

            }
        }
        
    }
    
    public function LimpaSiteMenu($AplicacaoId = APPID){
        //if(defined(APP_ID))
            $this->unitofwork->Delete(new SiteMenu(), "AplicacaoId = '".$AplicacaoId."'");
    }
}
