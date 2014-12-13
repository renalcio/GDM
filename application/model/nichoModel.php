<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
use DAL\Pessoa;
class NichoModel
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
        if($Model->NichoId > 0)
        {
            $Model = $this->pdo->GetById("Nicho", "NichoId", $Model->NichoId, "DAL\\Nicho");
        }
        return $Model;
    }

    public function GetToIndex($Model)
    {

            $Model = $this->pdo->select("SELECT * FROM Nicho", "", true);

        return $Model;
    }
    public function Save($model){
        if($model!=null) {
            $model = (object)$model;
            Helper::cast($model, "DAL\\Nicho");


            /* print_r($model);
             print_r($PessoaFisica);
             print_r($PessoaJuridica);*/

            if($model->NichoId > 0)
                $this->pdo->update("Nicho", $model, "NichoId = ".$model->NichoId);
            else
                $model->NichoId = $this->pdo->insert("Nicho", $model);

        }
    }
}
