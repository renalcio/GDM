<?php
namespace Modules\Generic\Controllers\Handlers;
use Core\Controller;
use Model\Pessoa;
use Model\PessoaAplicacao;
use Model\PessoaFisica;
use Model\PessoaJuridica;
use Model\Usuario;
use Model\UsuarioAplicacao;
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
        $retorno = $pdo->GetById("Pessoa", "PessoaId", $id, "Model\\Pessoa");
        $retorno = json_encode($retorno);
        echo $retorno;
    }

    function GetByDoc($doc){
        header('Content-Type: application/json; Charset=UTF-8');
        $doc = Helper::SomenteNumeros($doc);
        if(!empty($doc)) {
            /*$retorno = $this->unitofwork->select("SELECT p.* FROM Pessoa p, PessoaFisica pf, PessoaJuridica pj WHERE (p.PessoaId = pf.PessoaId AND pf.CPF = '$doc') OR
 (p.PessoaId = pj.PessoaId AND pj.CNPJ = '$doc') LIMIT 1", "Model\\Pessoa");*/

            $retorno = $this->unitofwork->Get(new Pessoa())->LeftJoin($this->unitofwork->Get(new PessoaFisica()), "p.PessoaId", "pf.PessoaId")->LeftJoin($this->unitofwork->Get(new PessoaJuridica()), "p.PessoaId", "pj.PessoaId")->Where("(p.PessoaId = pf.PessoaId AND pf.CPF = '".$doc."') OR (p.PessoaId = pj.PessoaId AND pj.CNPJ = '".$doc."')")->Select("p.*", new Pessoa())->First();
        }
        $retorno = json_encode($retorno);

        echo $retorno;
    }

    function Select2Tag()
    {
        header('Content-Type: application/json; Charset=UTF-8');
        $retorno = Array();
        $uow = new UnitofWork();
        $sql = $uow->Get(new UsuarioAplicacao(), "AplicacaoId = '" . APPID . "'")->Join($uow->Get(new Usuario()), "ua.UsuarioId", "u.UsuarioId")->Join($uow->Get(new Pessoa()), "u.PessoaId", "p.PessoaId")->Select("DISTINCT(p.PessoaId), p.Nome")->ToArray();
        if (count($sql) > 0) {
            foreach ($sql as $item) {
                $add = new \stdClass();
                $add->id = $item->PessoaId;
                $add->text = $item->Nome;
                $retorno[] = $add;
            }
        }

        echo json_encode($retorno);
    }
}
?>