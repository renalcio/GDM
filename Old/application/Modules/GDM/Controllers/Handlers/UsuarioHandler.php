<?php
namespace Modules\GDM\Controllers\Handlers;
use Core\Controller;
use DAL\Pessoa;
use DAL\PessoaFisica;
use DAL\PessoaJuridica;
use DAL\Usuario;
use DAL\UsuarioAplicacao;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class UsuarioHandler extends Controller
{
    function MudaStatus($id,$status)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        if($id > 0 && !empty($status)) {
            $uow = new UnitofWork();

            if($status == "true")
                $status = 1;
            else
                $status = 0;

            $UA = new UsuarioAplicacao();
            $UA->Ativo = $status;
            $UA->UsuarioId = $id;
            $UA->Aplicacao = APPID;

            echo $uow->Update($UA);
        }
    }

    function GetByDoc($doc){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $uow = new UnitofWork();
        $doc = Helper::SomenteNumeros($doc);
        if(!empty($doc)) {
            /*$retorno = $pdo->select("SELECT u.* FROM Usuario u, Pessoa p, PessoaFisica pf, PessoaJuridica pj WHERE u.PessoaId = p.PessoaId AND (p.PessoaId
= pf
.PessoaId AND pf.CPF = '$doc') OR
 (p.PessoaId = pj.PessoaId AND pj.CNPJ = '$doc') LIMIT 1", "DAL\\Usuario");*/

            $retorno = $uow->Get(new Usuario)->Join($uow->Get(new Pessoa()), "u.PessoaId", "p.PessoaId")->LeftJoin($uow->Get(new PessoaFisica()), "p.PessoaId", "pf.PessoaId")->LeftJoin($uow->Get(new PessoaJuridica()), "p.PessoaId", "pj.PessoaId")->Where("(p.PessoaId = pf.PessoaId AND pf.CPF = '') OR (p.PessoaId = pj.PessoaId AND pj.CNPJ = '')")->Select("u.*", new Usuario())->First();
        }
        $retorno = json_encode($retorno);

        echo $retorno;
    }

}
?>