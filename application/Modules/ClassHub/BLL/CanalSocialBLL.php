<?php
/**
 * Model
 * Titulo: CanalSocials
 * Autor: renalcio.freitas
 * Data: 06/05/2015
 */
namespace Modules\ClassHub\BLL;
use Core\BLL;
use Libs\FileHelper;
use Libs\ListHelper;
use Libs\UsuarioHelper;
use Model\ClassHub\CanalSocial;
use Libs\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\ModelState;
use Libs\Session;
use Libs\Usuario;
use Libs\Debug;
use Model\ClassHub\CanalSocialArquivo;
use Model\Pessoa;
use Modules\ClassHub\Libs\AlunoHelper;

class CanalSocialBLL extends BLL
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

    public function GetToEdit(CanalSocial $model)
    {
        $model->ListArquivo = new ListHelper();


        if($model->CanalSocialId > 0)
        {
            $model = $this->unitofwork->GetById(new CanalSocial(), $model->CanalSocialId);

        }else{
            $model = new CanalSocial();
        }
        return $model;
    }

    public function GetToIndex($model)
    {

        $model->Lista = $this->unitofwork->Get(new CanalSocial())->ToList();

        return $model;
    }

    public function Save(CanalSocial $model){

        if($model!=null) {

            if(empty($model->AlunoId)){
                $model->AlunoId = AlunoHelper::GetAlunoId();
            }
                if ($model->CanalSocialId > 0){

                    $this->unitofwork->Update($model);
                } else {
                    $this->unitofwork->Insert($model);
                }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new CanalSocial(), $id);
        }
    }

    public function Validar(CanalSocial $model)
    {

    }
}
