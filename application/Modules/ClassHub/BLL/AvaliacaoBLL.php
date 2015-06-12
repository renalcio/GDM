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
            $arrFiles = FileHelper::DirList(UPLOAD_APP_DIR.'avaliacoes\\'.$model->AvaliacaoId, ["thumbnail"]);
            foreach($arrFiles as $dir=>$files){
                if($dir != UsuarioHelper::GetUsuarioPessoaId()) {
                    $autor = $this->unitofwork->GetById(new Pessoa(), $dir);
                    foreach ($files as $k => $file) {
                        $addFile = new AvaliacaoArquivo();
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
                    $this->unitofwork->Insert($model);

                    $UsuarioId = UsuarioHelper::GetUsuarioPessoaId();

                    $PastaTemp = UPLOAD_APP_DIR.'avaliacoes'.DIRECTORY_SEPARATOR.'0'.DIRECTORY_SEPARATOR.$UsuarioId;
                    $PastaFinal = UPLOAD_APP_DIR.'avaliacoes'.DIRECTORY_SEPARATOR.$model->AvaliacaoId.DIRECTORY_SEPARATOR
                        .$UsuarioId;

                    FileHelper::MoveDir($PastaTemp,$PastaFinal);
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
