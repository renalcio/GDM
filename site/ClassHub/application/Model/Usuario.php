<?php
namespace Model;
use Libs\Database;
use Libs\UnitofWork;

class Usuario
{
    var $PessoaId;

    /**
     * @PrimaryKey
     */
    var $UsuarioId;

    /**
     * @Required
     * @DisplayName: Nome de Usuário
     */
    var $Login;
    var $Senha;
    var $Avatar;

    /**
     * @NotMapped
     */
    var $Pessoa;

    /**
     * @NotMapped
     * @DisplayName: Nova Senha
     */
    var $NovaSenha;

    /**
     * @NotMapped
     * @DisplayName: Confirmar Senha
     */
    var $ConfirmarNovaSenha;

    /**
     * @NotMapped
     */
    var $file;

    /**
     * @NotMapped
     * @Required
     * @DisplayName: Perfís
     */
    var $ListPerfil;

    /**
     * @NotMapped
     */
    var $Aplicacao;

    public function __construct($UsuarioId=0, $PessoaId=0, $AplicacaoId = 0, $Login="", $Senha="", $Avatar="", $NovaSenha="", $ConfirmarNovaSenha="")
    {
        $pdo = new UnitofWork();
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
            $this->Pessoa = $pdo->GetById(new Pessoa(), $this->PessoaId);
            $Perfis = $pdo->Get(new UsuarioPerfil(), "UsuarioId = ".$this->UsuarioId)->ToArray();
            $this->ListPerfil = "";
            for($i = 0; $i < count($Perfis); $i++){
                $this->ListPerfil .= $Perfis[$i]->PerfilId.($i ==(count($Perfis)-1) ? "" : ",");
            }
        }else
            $this->Pessoa = new Pessoa();

        if($this->Avatar == null || empty($this->Avatar))
            $this->Avatar = URL."img/avatar5.png";


        return $this;
    }

}
