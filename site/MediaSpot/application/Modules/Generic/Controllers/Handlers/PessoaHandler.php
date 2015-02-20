<?php
namespace Controllers\Handlers;
use Core\Controller;
use DAL\Pessoa;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class PessoaHandler extends Controller
{
    function GetAll()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $retorno = $this->unitofwork->Get(new Pessoa());

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
        $doc = Helper::SomenteNumeros($doc);
        if(!empty($doc)) {
            /*$retorno = $this->unitofwork->select("SELECT p.* FROM Pessoa p, PessoaFisica pf, PessoaJuridica pj WHERE (p.PessoaId = pf.PessoaId AND pf.CPF = '$doc') OR
 (p.PessoaId = pj.PessoaId AND pj.CNPJ = '$doc') LIMIT 1", "DAL\\Pessoa");*/

            $retorno = $this->unitofwork->Get(new Pessoa())->LeftJoin($this->unitofwork->Get(new PessoaFisica()), "p.PessoaId", "pf.PessoaId")->LeftJoin($this->unitofwork->Get(new PessoaJuridica()), "p.PessoaId", "pj.PessoaId")->Where("(p.PessoaId = pf.PessoaId AND pf.CPF = '') OR (p.PessoaId = pj.PessoaId AND pj.CNPJ = '')")->Select("p.*", new Pessoa())->First();
        }
        $retorno = json_encode($retorno);

        echo $retorno;
    }
}
?>