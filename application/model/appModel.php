<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
use DAL\Pessoa;
class AppModel
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
        if($Model->AplicacaoId > 0)
        {
            $Model = $this->pdo->GetById("Aplicacao", "AplicacaoId", $Model->AplicacaoId, "DAL\\Aplicacao");
        }
        return $Model;
    }

    public function GetToIndex($model)
    {
        $model->ListApps = $this->pdo->select("SELECT * FROM Aplicacao", "", true);

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

            print_r($model);
        }
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Aplicacao", "AplicacaoId = '".$id."'");
        }
    }
}
