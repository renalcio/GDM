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
            Helper::cast($model, "DAL\\Usuario");
            Helper::cast($model->Pessoa, "DAL\\Pessoa");
            Helper::cast($model->Pessoa->PessoaFisica, "DAL\\PessoaFisica");
            Helper::cast($model->Pessoa->PessoaJuridica, "DAL\\PessoaJuridica");

            $ModelPessoa = new PessoaModel($this->db);

            $model->Pessoa = $ModelPessoa->Save($model->Pessoa);

            $model->PessoaId = $model->Pessoa->PessoaId;

            /*echo "<pre>";
            print_r($model);
            echo "</pre>";
            print_r($PessoaFisica);
            print_r($PessoaJuridica);*/

             if($model->UsuarioId > 0) {
                 $usuario = $this->pdo->GetById("Usuario", "UsuarioId", $model->UsuarioId, "DAL\\Usuario");

                 if(!empty($model->NovaSenha) && !empty($model->ConfirmarNovaSenha) && $model->NovaSenha == $model->ConfirmarNovaSenha){
                     $model->Senha = md5($model->NovaSenha);
                 }else{
                     $model->Senha = $usuario->Senha;
                 }

                 $this->pdo->update("Usuario", $model, "UsuarioId = " . $model->UsuarioId);
             }
             else {
                 $model->Senha = md5($model->Senha);
                 $model->UsuarioId = $this->pdo->insert("Usuario", $model);
             }

        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Usuario", "UsuarioId = '".$id."'");
        }
    }
}
