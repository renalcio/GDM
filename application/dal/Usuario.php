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


    /**
     * @NotMapped
     */
    var $file;

    /**
     * @NotMapped
     */
    var $ListPerfil;

    /**
     * @NotMapped
     */
    var $Aplicacao;

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

        if($this->UsuarioId > 0 && $this->PessoaId > 0) {
            $this->Pessoa = $pdo->GetById("Pessoa", "PessoaId", $this->PessoaId, "DAL\\Pessoa");
            $Perfis = $pdo->select("SELECT * FROM usuarioperfil WHERE UsuarioId = ".$this->UsuarioId, "", true);
            $this->ListPerfil = "";
            for($i = 0; $i < count($Perfis); $i++){
                $this->ListPerfil .= $Perfis[$i]->PerfilId.($i ==(count($Perfis)-1) ? "" : ",");
            }

            //Aplicacao
            if($this->AplicacaoId > 0)
                $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }else
            $this->Pessoa = new Pessoa();

        if($this->Avatar == null || empty($this->Avatar))
            $this->Avatar = URL."img/avatar5.png";


        return $this;
    }

}
