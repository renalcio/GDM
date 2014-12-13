<?php
namespace Controllers\Handler;
use Core\Controller;
use Classe\Database;
use Libs\Helper;

class PessoaHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->select("SELECT * FROM Pessoa");

        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function GetById($id){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $retorno = $pdo->GetById("Pessoa", "PessoaId", $id, "DAL\\Pessoa");
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function GetByDoc($doc){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $doc = Helper::SomenteNumeros($doc);
        $retorno = $pdo->select("SELECT p.* FROM Pessoa p, PessoaFisica pf, PessoaJuridica pj WHERE (p.PessoaId = pf.PessoaId AND pf.CPF = '$doc') OR
 (p.PessoaId = pj.PessoaId AND pj.CNPJ = '$doc') LIMIT 1", "DAL\\Pessoa");

        $retorno = json_encode($retorno);

        echo $retorno;
    }
}
?>