<?php
/**
 * Model
 * Titulo: Alunos
 * Autor: renalcio.freitas
 * Data: 20/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use DAL\ClassHub\Aluno;
use DAL\Pessoa;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class AlunoBLL extends BLL
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

    public function GetToEdit(Aluno $model)
    {
        if($model->AlunoId > 0)
        {
            $model = $this->unitofwork->GetById(new Aluno(), $model->AlunoId);
        }else{
            $model = new Aluno();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Aluno())->ToList();

        return $model;
    }

    public function Save(Aluno $model){
        if($model!=null) {
            $clsPessoa = new Pessoa();
            $clsPessoa->Nome = $model->Pessoa["Nome"];
            $clsPessoa->Email = strtolower($model->Pessoa["Email"]);
            $clsPessoaCheck = $this->unitofwork->Get(new Pessoa(), "LOWER(Email) = '".$clsPessoa->Email."'")->ToList();
            if($clsPessoaCheck->Count() > 0) {
                $clsPessoa = $clsPessoaCheck->First();
                $clsPessoa->Nome = $model->Pessoa["Nome"];
            }else{
                $this->unitofwork->Insert($clsPessoa);
            }
            $model->PessoaId = $clsPessoa->PessoaId;
            if($model->Representante != 0)
                $model->Representante = 1;

            if ($model->AlunoId > 0){
                $this->unitofwork->Update($model);
            } else {
                $this->unitofwork->Insert($model);
            }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Aluno(), $id);
        }
    }

    public function Validar(Aluno $model)
    {

    }
}
