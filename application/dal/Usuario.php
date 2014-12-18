<?php
namespace DAL;
use Classe\Database;
class Usuario
{
    var $PessoaId;
    var $UsuarioId;
    var $AplicacaoId;
    var $Login;
    var $Senha;
    var $Avatar;

    /**
     * @NotMapped
     */
    var $Pessoa;
    /**
     * @NotMapped
     */
    var $NovaSenha;
    /**
     * @NotMapped
     */
    var $ConfirmarNovaSenha;

    public function __construct($UsuarioId=0, $PessoaId=0, $AplicacaoId = 0, $Login="", $Senha="", $Avatar="", $NovaSenha="", $ConfirmarNovaSenha="")
    {
        $pdo = new Database();
        if(!empty($Login)) {
            $this->PessoaId = $PessoaId;
            $this->UsuarioId = $UsuarioId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Login = $Login;
            $this->Senha = $Senha;
            $this->Avatar = $Avatar;
            $this->NovaSenha = $NovaSenha;
            $this->ConfirmarNovaSenha = $ConfirmarNovaSenha;
        }

        if($this->UsuarioId > 0 && $this->PessoaId > 0)
            $this->Pessoa = $pdo->GetById("Pessoa", "PessoaId", $this->PessoaId, "DAL\\Pessoa");
        else
            $this->Pessoa = new Pessoa();


        return $this;
    }

}
