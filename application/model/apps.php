<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
class Apps
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

    
    public function getApps()
    {
        $retorno = $this->pdo->select("SELECT * FROM Aplicacao");
        return $retorno;
    }

    public function getAppbyId($id)
    {
        $retorno = $this->pdo->select("SELECT * FROM Aplicacao WHERE AplicacaoId='$id'");
        if(count($retorno) > 0)
            return $retorno[0];

        return null;
    }
}
