<?php
/**
 * Model
 * Titulo: Professors
 * Autor: renalcio.freitas
 * Data: 20/04/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use DAL\ClassHub\Professor;
use DAL\Pessoa;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;

class ProfessorBLL extends BLL
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

    public function GetToEdit(Professor $model)
    {
        if($model->ProfessorId > 0)
        {
            $model = $this->unitofwork->GetById(new Professor(), $model->ProfessorId);
        }else{
            $model = new Professor();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Professor())->ToList();

        return $model;
    }

    public function Save(Professor $model){
        if($model!=null) {
            $clsPessoa = new Pessoa();

            if(!empty($model->PessoaId))
                $clsPessoa = $this->unitofwork->GetById(new Pessoa(), $model->PessoaId);
            $clsPessoa->Nome = $model->Pessoa["Nome"];
            $clsPessoa->Email = strtolower($model->Pessoa["Email"]);
            $clsPessoaCheck = $this->unitofwork->Get(new Pessoa(), "LOWER(Email) = '".$clsPessoa->Email."'")->ToList();
            if($clsPessoaCheck->Count() > 0) {
                $clsPessoa = $clsPessoaCheck->First();
                $clsPessoa->Nome = $model->Pessoa["Nome"];
            }

            if(!empty($clsPessoa->PessoaId)) {
                $this->unitofwork->Update($clsPessoa);
            }else
            {
                $this->unitofwork->Insert($clsPessoa);
            }
            $model->PessoaId = $clsPessoa->PessoaId;

            if ($model->ProfessorId > 0){
                $this->unitofwork->Update($model);
            } else {
                $this->unitofwork->Insert($model);
            }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new Professor(), $id);
        }
    }

    public function Validar(Professor $model)
    {

    }
}
