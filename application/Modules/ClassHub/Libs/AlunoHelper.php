<?php
/**
 * Created by PhpStorm.
 * User: renalcio.freitas
 * Date: 13/02/2015
 * Time: 14:53
 */

namespace Modules\ClassHub\Libs;

use Core\Lib;
use Model\ClassHub\Aluno;
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

    public static function GetUsuarioEscolaId(){
        $unitofwork = new UnitofWork();
        $sessao = new SessionHelper("GDMAuth");
        $PessoaId = $sessao->Ver("PessoaId");

        $aluno = $unitofwork->Get(new Aluno(), "PessoaId = '".$PessoaId."'");

        return $aluno->EscolaId;
    }

    public static function GetUsuarioAluno(){
        $unitofwork = new UnitofWork();
        $sessao = new SessionHelper("GDMAuth");
        $PessoaId = $sessao->Ver("PessoaId");

        $aluno = new Aluno();
        $aluno = $unitofwork->Get(new Aluno(), "PessoaId = '".$PessoaId."'")->FirstOrDefault();
        if(!isset($aluno) || empty($aluno))
            $aluno = new Aluno();

        return $aluno;
    }

    public static function AddPontos($Pontos, $AlunoId = 0){
        $unitofwork = new UnitofWork();
        $clsAluno = new Aluno();
        if(empty($AlunoId))
            $clsAluno = self::GetUsuarioAluno();
        else
            $clsAluno = $unitofwork->GetById(new Aluno(), $AlunoId);

        $clsAluno->Pontos += $Pontos;

        $unitofwork->Update($clsAluno);
    }

    public static function RemovePontos($Pontos, $AlunoId = 0){
        self::AddPontos(-$Pontos, $AlunoId);
    }

    public static function GetPontos($AlunoId = 0){
        $unitofwork = new UnitofWork();
        $clsAluno = new Aluno();
        if(empty($AlunoId))
            $clsAluno = self::GetUsuarioAluno();
        else
            $clsAluno = $unitofwork->GetById(new Aluno(), $AlunoId);

        return $clsAluno->Pontos;
    }

}