<?php
namespace Model;
use Classe\Database;
use DAL\Perfil;
use Libs\Helper;
class PerfilModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->pdo = new Database;
    }

    public function GetToEdit($Model)
    {
        if($Model->PerfilId > 0)
        {
            $Model = $this->pdo->GetById("Perfil", "PerfilId", $Model->PerfilId, "DAL\\Perfil");
        }else{
            $Model = new Perfil();
        }
        return $Model;
    }

    public function GetToIndex($Model)
    {

        $Model = $this->pdo->select("SELECT * FROM Perfil WHERE AplicacaoId = ".APPID." OR ".APPID." = ".ROOTAPP,
            "DAL\\Perfil",
            true);

        return $Model;
    }
    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Perfil");


            /* print_r($model);
             print_r($PessoaFisica);
             print_r($PessoaJuridica);*/

            if($model->NichoId > 0)
                $this->pdo->update("Perfil", $model, "PerfilId = ".$model->PerfilId);
            else {
                $model->Ativo = 1;
                $model->PerfilId = $this->pdo->insert("Perfil", $model);
            }
        }
        return $model;
    }

    public function Deletar($id){
        if($id > 0){
            $this->pdo->delete("Perfil", "PerfilId = '".$id."'");
        }
    }
}
