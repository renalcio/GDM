<?php
namespace BLL\GDM;
use BLL\BLL;
use BLL\Generic\PessoaBLL;
use DAL\Aplicacao;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use DAL\Pessoa;
use Libs\UnitofWork;

class AplicacaoBLL extends BLL
{

    public function GetToEdit($Model)
    {
        if($Model->AplicacaoId > 0)
        {
            $Model = $this->unitofwork->GetById(new Aplicacao(), $Model->AplicacaoId);
        }
        return $Model;
    }

    public function GetToIndex($model)
    {
        $model->ListApps = $this->unitofwork->Get(new Aplicacao())->ToArray();

        return $model;
    }

    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Aplicacao");
            Helper::cast($model->Pessoa, "DAL\\Pessoa");
            Helper::cast($model->Pessoa->PessoaFisica, "DAL\\PessoaFisica");
            Helper::cast($model->Pessoa->PessoaJuridica, "DAL\\PessoaJuridica");

            $Pessoa = $model->Pessoa;
            $PessoaFisica = $model->Pessoa->PessoaFisica;
            $PessoaJuridica = $model->Pessoa->PessoaJuridica;
            $TipoPessoaFisica = $model->Pessoa->TipoPessoaFisica;

            $ModelPessoa = new PessoaBLL($this->db);

            $model->Pessoa = $ModelPessoa->Save($model->Pessoa);

            $model->PessoaId = $model->Pessoa->PessoaId;

            if($model->AplicacaoId > 0)
                $this->unitofwork->Update($model);
            else
                $this->unitofwork->Insert($model);

        }
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->Delete(new Aplicacao(), $id);
        }
    }
}
