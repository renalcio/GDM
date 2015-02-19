<?php
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Nicho;
use Libs\Database;
use Libs\UnitofWork;

class NichoHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->Get(new Nicho())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->select(new Nicho())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->NichoId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>