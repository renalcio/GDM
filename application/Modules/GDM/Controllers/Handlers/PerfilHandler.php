<?php
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Perfil;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;

class PerfilHandler extends Controller
{
    function MudaStatus($id,$status)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        if($id > 0 && !empty($status)) {
            $uow = new UnitofWork();

            if($status == "true")
                $status = 1;
            else
                $status = 0;

            $Perfil = new Perfil();
            $Perfil->Ativo = $status;
            $Perfil->PerfilId = $id;

            $uow->Update($Perfil);

            echo json_encode($Perfil);
        }
    }

    function Select2($AplicacaoId = APP_ID)
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Perfil(), "AplicacaoId = '".$AplicacaoId."' ")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->PerfilId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }

    function Select2Tag($AplicacaoId = 0)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $retorno = Array();
        $uow = new UnitofWork();
        $NIvel = UsuarioHelper::GetNivel();
        if($AplicacaoId > 0) {
            $sql = $uow->Get(new Perfil(), "
                                (
                                AplicacaoId = '" . $AplicacaoId . "'
                                AND Nivel >= '" . $NIvel . "'
                                )
                              OR
                                (
                                '".APPID."' = '".ROOTAPP."'
                                AND '".$AplicacaoId."' != '".ROOTAPP."'
                                AND AplicacaoId = '".$AplicacaoId."'
                                )")->ToArray();
            if (count($sql) > 0) {
                foreach ($sql as $item) {
                    $add = new \stdClass();
                    $add->id = $item->PerfilId;
                    $add->text = $item->Titulo;
                    $retorno[] = $add;
                }
            }
        }

        echo json_encode($retorno);
    }
}
?>