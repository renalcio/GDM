<?php
namespace Controllers\Handler;
use Core\Controller;
use Libs\Database;
use Libs\Helper;

class UsuarioHandler extends Controller
{
    function MudaStatus($id,$status)
    {
        header('Content-Type: application/json; Charset=UTF-8');
        if($id > 0 && !empty($status)) {
            $pdo = new Database();

            if($status == "true")
                $status = 1;
            else
                $status = 0;

            echo $pdo->update("UsuarioAplicacao", Array("Ativo" => $status), "UsuarioId = ".$id." AND AplicacaoId = '".APPID."'");
        }
    }

    function GetByDoc($doc){
        header('Content-Type: application/json; Charset=UTF-8');
        $pdo = new Database();
        $doc = Helper::SomenteNumeros($doc);
        if(!empty($doc)) {
            $retorno = $pdo->select("SELECT u.* FROM Usuario u, Pessoa p, PessoaFisica pf, PessoaJuridica pj WHERE u.PessoaId = p.PessoaId AND (p.PessoaId
= pf
.PessoaId AND pf.CPF = '$doc') OR
 (p.PessoaId = pj.PessoaId AND pj.CNPJ = '$doc') LIMIT 1", "DAL\\Usuario");
        }
        $retorno = json_encode($retorno);

        echo $retorno;
    }

}
?>