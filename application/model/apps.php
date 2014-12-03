<?php
namespace Model;
use Classe\Database;
use Libs\Helper;
use Libs\Cookie;
use Libs\Session;
use DAL\Pessoa;
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

    public function GetToEdit($Model)
    {
        if($Model->AplicacaoId > 0)
        {
            $Model = $this->getAppbyId($Model->AplicacaoId);
            if($Model != null)
            {
                $Model->Pessoa = $this->pdo->GetById("Pessoa", "PessoaId", $Model->PessoaId, "DAL\\Pessoa");
                if($Model->Pessoa != null){
                    if($Model->Pessoa->TipoPessoaFisica)
                        $Model->Documento = $Model->Pessoa->PessoaFisica->CPF;
                    else
                        $Model->Documento = $Model->Pessoa->PessoaJuridica->CNPJ;
                }
            }
        }
        return $Model;
    }

    public function getApps()
    {
        $retorno = $this->pdo->select("SELECT * FROM Aplicacao");
        return $retorno;
    }

    public function getAppbyId($id)
    {
        $retorno = $this->pdo->select("SELECT * FROM Aplicacao WHERE AplicacaoId='$id'");
        if(is_object($retorno))
            return $retorno;

        return null;
    }
}
