<?php
/**
 * Handler
 * Titulo: Permissão Handler
 * Autor: renalcio.freitas
 * Data: 20/01/2015
 */
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
use Libs\Helper;

class permissaoHandler extends Controller
{
    function acesso($MenuId, $PerfilId, $Acesso, $AplicacaoId){
        if(!empty($MenuId) && !empty($PerfilId) && !empty($Acesso)) {
            $pdo = new Database();

            if($Acesso == "true")
                $status = 1;
            else
                $status = 0;

            $check = $pdo->select("SELECT * FROM Permissao WHERE PerfilId='".$PerfilId."' AND MenuId = '".$MenuId."' AND AplicacaoId = '".$AplicacaoId."'",
                "", true);

            if($Acesso == "true"){
                //Permitir
                if(count($check) == 0){
                    $pdo->insert("Permissao", Array(
                        "MenuId" => $MenuId,
                        "AplicacaoId" => $AplicacaoId,
                        "PerfilId" => $PerfilId
                    ));
                }
            }else{
                if(count($check) > 0){
                    $pdo->delete("Permissao", "PerfilId='".$PerfilId."' AND MenuId = '".$MenuId."' AND AplicacaoId = '".$AplicacaoId."'", 0);
                }
            }
        }
    }
}