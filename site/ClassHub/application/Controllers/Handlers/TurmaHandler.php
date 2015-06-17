<?php
namespace Controllers\Handlers;
use Core\Controller;
use Model\Aplicacao;
use Model\ClassHub\Curso;
use Model\ClassHub\Escola;
use Model\ClassHub\Turma;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class TurmaHandler extends Controller
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

    function Select2($CursoId)
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new Turma())->Join($uow->Get(new Curso(), "c.CursoId = '".$CursoId."'"), "t.CursoId", "c
        .CursoId")->Select("t.*", new Turma())->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                //var_dump($item);
                $retorno .= "<option value='" . $item->TurmaId . "'>".$item->Semestre."S ".$item->Ano." - "
                    .$item->Turno." - ".$item->Curso->Titulo."</option>";
            }
        }

        echo $retorno;
    }
}
?>