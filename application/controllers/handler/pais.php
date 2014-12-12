<?php
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
class Pais extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->select("SELECT * FROM Pais");

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $pdo = new Database();
        $sql = $pdo->select("SELECT * FROM Pais");
        if (count($sql) > 0) {
            foreach ($sql as $pais) {
                $retorno .= "<option value='" . $pais->Nome . "'>" . $pais->Nome . "</option>";
            }
        }

        echo $retorno;
    }


    function FixName()
    {
        $pdo = new Database();
        $retorno = $pdo->select("SELECT * FROM Pais");
        foreach ($retorno as $pais) {
            $pais->Nome = ucfirst(mb_strtolower($pais->Nome, "UTF-8"));
            $pais->Name = ucfirst(mb_strtolower($pais->Name, "UTF-8"));
            $pdo->update("Pais", (Array)$pais, "PaisId = '" . $pais->PaisId . "'");
        }
        $retorno = $pdo->select("SELECT * FROM Pais");
        $retorno = json_encode($retorno);

        echo $retorno;
    }
}
?>