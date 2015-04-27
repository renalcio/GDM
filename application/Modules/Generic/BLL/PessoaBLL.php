<?php
namespace Modules\Generic\BLL;
use Core\BLL;
use DAL\PessoaAplicacao;
use DAL\PessoaFisica;
use DAL\PessoaJuridica;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use DAL\Pessoa;
class PessoaBLL extends BLL
{
    public function GetToEdit($Model)
    {
        if($Model->PessoaId > 0)
        {
            $Model = $this->unitofwork->GetById(new Pessoa(), $Model->PessoaId);
            if($Model != null)
            {
                $Model = $this->unitofwork->GetById(new Pessoa(), $Model->PessoaId);
                if($Model != null){
                    if($Model->TipoPessoaFisica)
                        $Model->Documento = $Model->PessoaFisica->CPF;
                    else
                        $Model->Documento = @$Model->PessoaJuridica->CNPJ;
                }
            }
        }
        return $Model;
    }

    public function GetToIndex($Model)
    {
        if(defined('APP_ID') && APP_ID == 1)
            $Model->ListPessoa = $this->unitofwork->Get(new Pessoa())->ToArray();
        else {
            /*$Model->ListPessoa = $this->unitofwork->pdo->select("SELECT p.*
                                            FROM
                                            ".DB_NAME.".Pessoa p,
                                            ".DB_NAME.".PessoaEmpresa pe,
                                            ".DB_NAME.".Aplicacao a
                                            WHERE a.AplicacaoId = " . APP_ID . "
                                            AND pe.EmpresaId = a.PessoaId
                                            AND p.PessoaId = pe.PessoaId", "", true);*/

            $Model->ListPessoa = $this->unitofwork->Get(new Pessoa())->Join(
                $this->unitofwork->Get(new PessoaAplicacao(), "pa.AplicacaoId = ".APPID),
                "p.PessoaId",
                "pa.PessoaId")->Select("p")->ToArray();

        }

        return $Model;
    }
    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Pessoa");
            Helper::cast($model->PessoaFisica, "DAL\\PessoaFisica");
            Helper::cast($model->PessoaJuridica, "DAL\\PessoaJuridica");

            $PessoaFisica = $model->PessoaFisica;
            $PessoaJuridica = $model->PessoaJuridica;
            $TipoPessoaFisica = $model->TipoPessoaFisica;

            /* print_r($model);
             print_r($PessoaFisica);
             print_r($PessoaJuridica);*/

            if($model->PessoaId > 0)
                $this->unitofwork->Update($model);
            else
                $model->PessoaId = $this->unitofwork->insert($model);


                if($PessoaFisica->PessoaId > 0)
                    $this->unitofwork->Update($PessoaFisica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaFisica->PessoaId = $model->PessoaId;
                    $this->unitofwork->Insert($PessoaFisica);
                }


                if($PessoaJuridica->PessoaId > 0)
                    $this->unitofwork->Update($PessoaJuridica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaJuridica->PessoaId = $model->PessoaId;
                    $this->unitofwork->Insert($PessoaJuridica);
                }

            //PessoaAplicacao
            //$checkPA = $this->unitofwork->select("SELECT * FROM PessoaAplicacao WHERE PessoaId = '".$model->PessoaId ."' AND AplicacaoId = '".APPID."'", "", true);

            $checkPA = $this->unitofwork->Get(new PessoaAplicacao(), "PessoaId = '".$model->PessoaId."' AND AplicacaoId = '".APPID."'")->First();

            if(count($checkPA)<=0){
                $add = new PessoaAplicacao();
                $add->PessoaId = $model->PessoaId;
                $add->AplicacaoId = APPID;
                $this->unitofwork->Insert($add);
            }


        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->unitofwork->Delete(new PessoaAplicacao(), "PessoaId = '".$id."' AND AplicacaoId = ".APPID);
        }
    }

    public function Validar($model)
    {
        $retorno = Array();
        if($model != null) {
            Helper::cast($model, "DAL\\Pessoa");
            Helper::cast($model->PessoaFisica, "DAL\\PessoaFisica");
            Helper::cast($model->PessoaJuridica, "DAL\\PessoaJuridica");


        }

        return $retorno;
    }
}
