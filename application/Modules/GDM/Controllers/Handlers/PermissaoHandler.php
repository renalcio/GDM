<?php
/**
 * Handler
 * Titulo: Permissão Handler
 * Autor: renalcio.freitas
 * Data: 20/01/2015
 */
namespace Modules\GDM\Controllers\Handlers;
use Core\Controller;
use DAL\Acesso;
use DAL\Perfil;
use DAL\Permissao;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class permissaoHandler extends Controller
{
    function acesso($MenuId, $PerfilId, $Acesso, $AplicacaoId){
        if(!empty($MenuId) && !empty($PerfilId) && !empty($Acesso)) {
            $uow = new UnitofWork();

            if($Acesso == "true")
                $status = 1;
            else
                $status = 0;

            $check = $uow->Get(new Acesso(), "PerfilId='".$PerfilId."' AND MenuId = '".$MenuId."' AND AplicacaoId = '".$AplicacaoId."'")->ToArray();

            if($Acesso == "true"){
                //Permitir
                if(count($check) == 0){
                    $Permissao = new Permissao();
                    $Permissao->MenuId = $MenuId;
                    $Permissao->AplicacaoId = $AplicacaoId;
                    $Permissao->PerfilId = $PerfilId;
                    $uow->Insert($Permissao);
                }
            }else{
                if(count($check) > 0){
                    $uow->Delete(new Permissao(), "PerfilId='".$PerfilId."' AND MenuId = '".$MenuId."' AND AplicacaoId = '".$AplicacaoId."'", 0);
                }
            }
        }
    }
}