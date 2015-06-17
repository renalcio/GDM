<?php
namespace Controllers\Handlers;
use Core\Controller;
use Model\Aplicacao;
use Model\ClassHub\Curso;
use Model\ClassHub\Escola;
use Model\ClassHub\MateriaCurso;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class MateriaHandler extends Controller
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

    function Select2($CursoId = 0)
    {
        $retorno = "";
        $uow = new UnitofWork();
        $sql = $uow->Get(new MateriaCurso(), "CursoId = '".$CursoId."' OR '".$CursoId."' = '0'")->Select("DISTINCT
        (MateriaCurso.MateriaId), MateriaCurso.MateriaCursoId")->GroupBy("MateriaCurso.MateriaId")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $clsMateriaCurso = $uow->GetById(new MateriaCurso(), $item->MateriaCursoId);
                $retorno .= "<option value='" . $clsMateriaCurso->MateriaId . "'>" . $clsMateriaCurso->Materia->Titulo . "</option>";
            }
        }

        echo $retorno;
    }
}
?>