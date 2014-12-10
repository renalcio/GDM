<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
use DAL\Pessoa;
class Pessoas
{
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
    }

    public function GetToEdit($Model)
    {
        if($Model->PessoaId > 0)
        {
            $Model = $this->pdo->GetById("Pessoa", "PessoaId", $Model->PessoaId, "DAL\\Pessoa");
            if($Model != null)
            {
                $Model = $this->pdo->GetById("Pessoa", "PessoaId", $Model->PessoaId, "DAL\\Pessoa");
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
            $Model->ListPessoa = $this->pdo->select("SELECT * FROM Pessoa", "", true);
        else {
            $Model->ListPessoa = $this->pdo->select("SELECT p.*
                                            FROM
                                            Pessoa p,
                                            PessoaEmpresa pe,
                                            Aplicacao a
                                            WHERE a.AplicacaoId = " . APP_ID . "
                                            AND pe.EmpresaId = a.PessoaId
                                            AND p.PessoaId = pe.PessoaId");
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

            if($TipoPessoaFisica){

                if($PessoaFisica->PessoaId > 0)
                    $this->pdo->update("PessoaFisica", $PessoaFisica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaFisica->PessoaId = $model->PessoaId;
                    $this->pdo->insert("PessoaFisica", $PessoaFisica);
                }

            }else{

                if($PessoaJuridica->PessoaId > 0)
                    $this->pdo->update("PessoaJuridica", $PessoaJuridica, "PessoaId = ".$model->PessoaId);
                else {
                    $PessoaJuridica->PessoaId = $model->PessoaId;
                    $this->pdo->insert("PessoaJuridica", $PessoaJuridica);
                }

            }

        }
    }
}
