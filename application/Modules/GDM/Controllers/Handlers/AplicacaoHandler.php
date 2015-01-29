<?php
namespace Controllers\Handlers;
use Core\Controller;
use Libs\Database;
use Libs\Helper;

class AplicacaoHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->select("SELECT * FROM Aplicacao");

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->GetById("Aplicacao", "AplicacaoId", $id, "DAL\\Aplicacao");
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Aplicacao", "", true);
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->AplicacaoId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>