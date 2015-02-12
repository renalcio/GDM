<?php
namespace BLL;
use Libs\Database;
use Libs\Helper;
use Libs\CookieHelper;
use Libs\SessionHelper;
use DAL\Pessoa;
class PessoaBLL
{
    var $pdo;
    var $unitofwork;
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->pdo = new Database;
        $this->unitofwork = new UnitofWork();
    }

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
            $Model->ListPessoa = $this->unitofwork->pdo->select("SELECT p.*
                                            FROM
                                            ".DB_NAME.".Pessoa p,
                                            ".DB_NAME.".PessoaEmpresa pe,
                                            ".DB_NAME.".Aplicacao a
                                            WHERE a.AplicacaoId = " . APP_ID . "
                                            AND pe.EmpresaId = a.PessoaId
                                            AND p.PessoaId = pe.PessoaId", "", true);
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
                $this->pdo->update("Pessoa", $model, "PessoaId = ".$model->PessoaId);
            else
                $model->PessoaId = $this->pdo->insert("Pessoa", $model);


                if($PessoaFisica->PessoaId > 0)
                    $this->pdo->update("PessoaFisica", $PessoaFisica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaFisica->PessoaId = $model->PessoaId;
                    $this->pdo->insert("PessoaFisica", $PessoaFisica);
                }


                if($PessoaJuridica->PessoaId > 0)
                    $this->pdo->update("PessoaJuridica", $PessoaJuridica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaJuridica->PessoaId = $model->PessoaId;
                    $this->pdo->insert("PessoaJuridica", $PessoaJuridica);
                }

            //PessoaAplicacao
            $checkPA = $this->pdo->select("SELECT * FROM PessoaAplicacao WHERE PessoaId = '".$model->PessoaId."' AND
            AplicacaoId = '".APPID."'",
                "", true);
            if(count($checkPA)<=0){
                $add = new \stdClass();
                $add->PessoaId = $model->PessoaId;
                $add->AplicacaoId = APPID;
                $this->pdo->insert("PessoaAplicacao", $add);
            }


        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Pessoa", "PessoaId = '".$id."'");
            $this->pdo->delete("PessoaFisica", "PessoaId = '".$id."'");
            $this->pdo->delete("PessoaJuridica", "PessoaId = '".$id."'");
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
