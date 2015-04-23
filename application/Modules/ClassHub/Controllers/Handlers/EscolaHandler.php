<?php
namespace Modules\ClassHub\Controllers\Handlers;
use Core\Controller;
use DAL\Aplicacao;
use DAL\ClassHub\Escola;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class EscolaHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->Get(new Escola())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->GetById(new Escola(), $id);
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Escola())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->EscolaId . "'>" . $item->Nome . "</option>";
            }
        }

        echo $retorno;
    }
}
?>