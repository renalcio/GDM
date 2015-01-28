<?php
namespace Controllers\Handler;
use Core\Controller;
use Libs\Database;
class NichoHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->select("SELECT * FROM Nicho");

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Nicho", "", true);
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->NichoId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>