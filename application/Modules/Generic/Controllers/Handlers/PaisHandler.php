<?php
namespace Modules\Generic\Controllers\Handlers;
use Core\Controller;
use Model\Pais;
use Libs\Database;
class PaisHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $retorno = $this->unitofwork->Get(new Pais())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $sql = $this->unitofwork->Get(new Pais())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $pais) {
                $retorno .= "<option value='" . $pais->Nome . "'>" . $pais->Nome . "</option>";
            }
        }

        echo $retorno;
    }


    function FixName()
    {
        $retorno = $this->unitofwork->Get(new Pais())->ToArray();
        foreach ($retorno as $pais) {
            $pais->Nome = ucfirst(mb_strtolower($pais->Nome, "UTF-8"));
            $pais->Name = ucfirst(mb_strtolower($pais->Name, "UTF-8"));
            $this->unitofwork->update($pais);
        }
        $retorno = $this->unitofwork->Get(new Pais())->ToArray();
        $retorno = json_encode($retorno);

        echo $retorno;
    }
}
?>