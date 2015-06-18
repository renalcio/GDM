<?php
/**
 * Model
 * Titulo: Aulas
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 */
namespace BLL;
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
use Model\ClassHub\Arquivo;
use Model\Pessoa;
use Libs\AlunoHelper;

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

    public function GetToDetails(Aula $model)
    {
        $model->ListAulaArquivo = new ListHelper();
        if($model->AulaId > 0)
        {
            $model = $this->unitofwork->GetById(new Aula(), $model->AulaId);
            $arrFiles = FileHelper::DirList(UPLOAD_APP_DIR.'aulas\\'.$model->AulaId, ["thumbnail"]);
            foreach($arrFiles as $dir=>$files){
                    $autor = $this->unitofwork->GetById(new Pessoa(), $dir);
                    foreach ($files as $k => $file) {
                        $addFile = new Arquivo();
                        $addFile->PessoaId = $dir;
                        $addFile->Pessoa = $autor;
                        $addFile->Titulo = $file["title"];
                        $addFile->Tamanho = $file["size"];
                        $addFile->Url = $file["url"];
                        $addFile->Tipo = $file["type"];
                        $addFile->img = $file["img"];
                        //var_dump($file);
                        if($model->ListAulaArquivo == null) $model->ListAulaArquivo = new ListHelper();
                        $model->ListAulaArquivo->Add($addFile);
                    }
            }
        }else{
            $model = new Aula();
            $clsAluno = AlunoHelper::GetUsuarioAluno();
            $model->EscolaId = $clsAluno->EscolaId;
            $model->CursoId = $clsAluno->Turma->CursoId;
            $model->TurmaId = $clsAluno->TurmaId;
        }
        return $model;
    }

    public function GetToEdit(Aula $model)
    {
        $model->ListAulaArquivo = new ListHelper();


        if($model->AulaId > 0)
        {
            $model = $this->unitofwork->GetById(new Aula(), $model->AulaId);
            $arrFiles = FileHelper::DirList(UPLOAD_APP_DIR.'aulas\\'.$model->AulaId, ["thumbnail"]);
            foreach($arrFiles as $dir=>$files){
                if($dir != UsuarioHelper::GetUsuarioPessoaId()) {
                    $autor = $this->unitofwork->GetById(new Pessoa(), $dir);
                    foreach ($files as $k => $file) {
                        $addFile = new Arquivo();
                        $addFile->PessoaId = $dir;
                        $addFile->Pessoa = $autor;
                        $addFile->Titulo = $file["title"];
                        $addFile->Tamanho = $file["size"];
                        $addFile->Url = $file["url"];
                        $addFile->Tipo = $file["type"];
                        $addFile->img = $file["img"];
                        //var_dump($file);
                        if($model->ListAulaArquivo == null) $model->ListAulaArquivo = new ListHelper();
                        $model->ListAulaArquivo->Add($addFile);
                    }
                }
            }
        }else{
            $model = new Aula();
            $clsAluno = AlunoHelper::GetUsuarioAluno();
            $model->EscolaId = $clsAluno->EscolaId;
            $model->CursoId = $clsAluno->Turma->CursoId;
            $model->TurmaId = $clsAluno->TurmaId;
        }
        return $model;
    }

    public function GetToIndex($model)
    {
        $TurmaId = AlunoHelper::GetUsuarioAluno()->TurmaId;
        $AlunoId = AlunoHelper::GetAlunoId();

        $model->Lista = $this->unitofwork->Get(new Aula(), "TurmaId = '".$TurmaId."' AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->ToList();

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
                    $this->unitofwork->Insert($model);

                    $UsuarioId = UsuarioHelper::GetUsuarioPessoaId();

                    $PastaTemp = UPLOAD_APP_DIR.'aulas'.DIRECTORY_SEPARATOR.'0'.DIRECTORY_SEPARATOR.$UsuarioId;
                    $PastaFinal = UPLOAD_APP_DIR.'aulas'.DIRECTORY_SEPARATOR.$model->AulaId.DIRECTORY_SEPARATOR.$UsuarioId;

                    FileHelper::MoveDir($PastaTemp,$PastaFinal);

                    if($model->Compartilhado > 0)
                        AlunoHelper::AddPontos(PONTOSADD);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $Model = $this->unitofwork->GetById(new Aula(), $id);
            $isTurma = ($Model->TurmaId == \Libs\AlunoHelper::GetUsuarioAluno()->TurmaId) ? true : false;
            if($isTurma) {
                $this->unitofwork->Delete(new Aula(), $id);
            }
        }
    }

    public function Validar(Aula $model)
    {

    }
}
