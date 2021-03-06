<?php
/**
 * Model
 * Titulo: Aulas
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Libs\FileHelper;
use Libs\ListHelper;
use Libs\UsuarioHelper;
use Model\ClassHub\Aula;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use Model\ClassHub\AulaArquivo;
use Model\Pessoa;
use Modules\ClassHub\Libs\AlunoHelper;

class AulaBLL extends BLL
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        parent::__construct();
    }

    public function GetToEdit(Aula $model)
    {
        $model->ListAulaArquivo = new ListHelper();


        if($model->AulaId > 0)
        {
            $model = $this->unitofwork->GetById(new Aula(), $model->AulaId);

        }else{
            $model = new Aula();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Aula())->ToList();

        return $model;
    }

    public function Save(Aula $model){

        if($model!=null) {

            if(empty($model->AlunoId)){
                $model->AlunoId = AlunoHelper::GetAlunoId();
            }
                if ($model->AulaId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $model->Compartilhado = 1;
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Aula(), $id);
        }
    }

    public function Validar(Aula $model)
    {

    }
}
