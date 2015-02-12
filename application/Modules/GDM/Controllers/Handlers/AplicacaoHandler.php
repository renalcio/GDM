<?php
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Aplicacao;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class AplicacaoHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->Get(new Aplicacao())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->GetById(new Aplicacao(), $id);
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function Select2()
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Aplicacao())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->AplicacaoId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>