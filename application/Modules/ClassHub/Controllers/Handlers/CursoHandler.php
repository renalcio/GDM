<?php
namespace Modules\ClassHub\Controllers\Handlers;
use Core\Controller;
use DAL\Aplicacao;
use DAL\ClassHub\Curso;
use DAL\ClassHub\Escola;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class CursoHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->Get(new Curso())->ToArray();

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $uow = new UnitofWork();
        $retorno = $uow->GetById(new Curso(), $id);
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function Select2($EscolaId = 0)
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Curso(), "EscolaId = '".$EscolaId."' OR '".$EscolaId."' = '0'")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $retorno .= "<option value='" . $item->CursoId . "'>" . $item->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>