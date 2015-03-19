<?php
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Aplicacao;
use DAL\Modulo;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class ModuloHandler extends Controller
{
    function Select2()
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Modulo())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->ModuloId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>