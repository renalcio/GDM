<?php
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
use Libs\Helper;

class PerfilHandler extends Controller
{
    function MudaStatus($id,$status)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        if($id > 0 && !empty($status)) {
            $pdo = new Database();

            if($status == "true")
                $status = 1;
            else
                $status = 0;

            echo $pdo->update("Perfil", Array("Ativo" => $status), "PerfilId = ".$id);
        }
    }

    function Select2($AplicacaoId = 0)
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Perfil WHERE AplicacaoId = '".$AplicacaoId."' OR '".$AplicacaoId."' = '0'", "", true);
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
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Perfil WHERE AplicacaoId = '".$AplicacaoId."' OR '".$AplicacaoId."' = '0'", "", true);
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $add = new \stdClass();
                $add->id = $item->PerfilId;
                $add->text = $item->Titulo;
                $retorno[] = $add;
            }
        }

        echo json_encode($retorno);
    }
}
?>