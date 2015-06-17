<?php
/**
 * Model
 * Titulo: Avaliacaos
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Libs\FileHelper;
use Libs\ListHelper;
use Libs\UsuarioHelper;
use Model\ClassHub\Avaliacao;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use Model\ClassHub\AvaliacaoArquivo;
use Model\Pessoa;
use Modules\ClassHub\Libs\AlunoHelper;

class AvaliacaoBLL extends BLL
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

    public function GetToEdit(Avaliacao $model)
    {
        $model->ListArquivo = new ListHelper();


        if($model->AvaliacaoId > 0)
        {
            $model = $this->unitofwork->GetById(new Avaliacao(), $model->AvaliacaoId);
        }else{
            $model = new Avaliacao();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new Avaliacao())->ToList();

        return $model;
    }

    public function Save(Avaliacao $model){

        if($model!=null) {

            if(empty($model->AlunoId)){
                $model->AlunoId = AlunoHelper::GetAlunoId();
            }
                if ($model->AvaliacaoId > 0){

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
            $this->unitofwork->Delete(new Avaliacao(), $id);
        }
    }

    public function Validar(Avaliacao $model)
    {

    }
}
