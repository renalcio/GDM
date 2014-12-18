<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
use DAL\Pessoa;
class UsuarioModel
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
        if($Model->UsuarioId > 0)
        {
            $Model = $this->pdo->GetById("Usuario", "UsuarioId", $Model->UsuarioId, "DAL\\Usuario");

        }
        return $Model;
    }

    public function GetToIndex($Model)
    {
        if(defined('APP_ID') && APP_ID == 1)
            $Model->ListUsuario = $this->pdo->select("SELECT * FROM Usuario", "DAL\\Usuario", true);
        else {
            $Model->ListUsuario = $this->pdo->select("SELECT Usuario WHERE AplicacaoId = " . APP_ID, "DAL\\Usuario", true);
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
}
