<?php
namespace Modules\ClassHub\Controllers\Handlers;
use Core\Controller;
use Model\Aplicacao;
use Model\ClassHub\Professor;
use Model\ClassHub\Escola;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class ProfessorHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->Get(new Professor())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->GetById(new Professor(), $id);
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function Select2($EscolaId = 0)
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Professor(), "EscolaId = '".$EscolaId."' OR '".$EscolaId."' = '0'")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->ProfessorId . "'>" . $item->Pessoa->Nome . "</option>";
            }
        }

        echo $retorno;
    }
}
?>