<?php
/**
 * Created by PhpStorm.
 * User: renalcio.freitas
 * Date: 13/02/2015
 * Time: 14:53
 */

namespace Modules\ClassHub\Libs;

use Core\Lib;
use DAL\ClassHub\Aluno;
use Libs\Helper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;

class AlunoHelper extends Lib {

    public static function GetAlunoId($PessoaId = 0){
        $unitofwork = new UnitofWork();
        if(empty($PessoaId)){
            $PessoaId = UsuarioHelper::GetUsuarioPessoaId();
        }

        $clsAluno = $unitofwork->Get(new Aluno(), "PessoaId = '".$PessoaId."'")->FirstOrDefault();

        return $clsAluno->AlunoId;
    }

}