<?php
/**
 * Model
 * Titulo: Avaliacaos
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 */
namespace BLL;
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
use Model\ClassHub\Arquivo;
use Model\Pessoa;
use Libs\AlunoHelper;

class AvaliacaoBLL extends BLL
{
    function __construct()
    {

        parent::__construct();
    }

    public function GetToDetails(Avaliacao $model)
    {
        $model->ListArquivo = new ListHelper();


        if($model->AvaliacaoId > 0)
        {
            $model = $this->unitofwork->GetById(new Avaliacao(), $model->AvaliacaoId);
            $model->ListArquivo = new ListHelper();
            $arrFiles = FileHelper::DirList(UPLOAD_APP_DIR.'avaliacoes\\'.$model->AvaliacaoId, ["thumbnail"]);
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
                        //if(!isset($model->ListArquivo) or empty($model->ListArquivo)) $model->ListAvaliacaoArquivo = new ListHelper();
                        $model->ListArquivo->Add($addFile);
                    }
            }
        }else{
            $model = new Avaliacao();
            $clsAluno = AlunoHelper::GetUsuarioAluno();
            $model->EscolaId = $clsAluno->EscolaId;
            $model->CursoId = $clsAluno->Turma->CursoId;
            $model->TurmaId = $clsAluno->TurmaId;
        }
        return $model;
    }

    public function GetToEdit(Avaliacao $model)
    {
        $model->ListArquivo = new ListHelper();


        if($model->AvaliacaoId > 0)
        {
            $model = $this->unitofwork->GetById(new Avaliacao(), $model->AvaliacaoId);
            $arrFiles = FileHelper::DirList(UPLOAD_APP_DIR.'avaliacoes\\'.$model->AvaliacaoId, ["thumbnail"]);
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
                        if($model->ListArquivo == null) $model->ListAvaliacaoArquivo = new ListHelper();
                        $model->ListArquivo->Add($addFile);
                    }
                }
            }
        }else{
            $model = new Avaliacao();
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
        $model->Lista = $this->unitofwork->Get(new Avaliacao(), "TurmaId = '".$TurmaId."' AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->ToList();

        $model->clsProva = $this->unitofwork->Get(new Avaliacao(), "(STR_TO_DATE(Data,
        '%d/%m/%Y') >= STR_TO_DATE('".date("d/m/Y", time())."', '%d/%m/%Y')) AND (Trabalho = 0)  AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->OrderBy("STR_TO_DATE
        (Data, '%d/%m/%Y')")->FirstOrDefault();

        $model->clsTrabalho = $this->unitofwork->Get(new Avaliacao(), "(STR_TO_DATE(Data,
        '%d/%m/%Y') >= STR_TO_DATE('".date("d/m/Y", time())."', '%d/%m/%Y')) AND (Trabalho = 1)  AND (Compartilhado = 1 OR
        AlunoId = '".$AlunoId."')")->OrderBy("STR_TO_DATE
        (Data, '%d/%m/%Y')")->FirstOrDefault();

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
                    $this->unitofwork->Insert($model);

                    $UsuarioId = UsuarioHelper::GetUsuarioPessoaId();

                    $PastaTemp = UPLOAD_APP_DIR.'avaliacoes'.DIRECTORY_SEPARATOR.'0'.DIRECTORY_SEPARATOR.$UsuarioId;
                    $PastaFinal = UPLOAD_APP_DIR.'avaliacoes'.DIRECTORY_SEPARATOR.$model->AvaliacaoId.DIRECTORY_SEPARATOR
                        .$UsuarioId;

                    FileHelper::MoveDir($PastaTemp,$PastaFinal);

                    if($model->Compartilhado > 0)
                        AlunoHelper::AddPontos(PONTOSADD);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $Model = $this->unitofwork->GetById(new Avaliacao(), $id);
            $isTurma = ($Model->TurmaId == AlunoHelper::GetUsuarioAluno()->TurmaId) ? true : false;
            if($isTurma) {
                $this->unitofwork->Delete(new Avaliacao(), $id);
            }
        }
    }

    public function Validar(Avaliacao $model)
    {

    }
}
