<?php
namespace DAL;
use Libs\Database;
class UsuarioAplicacao
{
    var $UsuarioAplicacaoId;

    /**
     * @Required
     * @DisplayName: Usuário
     */
    var $UsuarioId;
    /**
     * @Required
     * @DisplayName: Aplicação
     */
    var $AplicacaoId;


    /**
     * @NotMapped
     * @Required
     * @DisplayName: CPF / CNPJ
     */
    var $Documento;

    /**
     * @NotMapped
     * @Required
     * @DisplayName: Perfís
     */
    var $ListPerfil;

    /**
     * @NotMapped
     */
    var $Usuario;



    /**
     * @NotMapped
     * @DisplayName: Nome
     */
    var $Nome;

    /**
     * @NotMapped
     */
    var $Aplicacao;

    public function __construct($UsuarioAplicacaoId = 0, $UsuarioId=0, $AplicacaoId = 0, $Documento="", $Nome="")
    {
        $pdo = new Database();
        if(!empty($Documento)) {
            $this->UsuarioAplicacaoId = $UsuarioAplicacaoId;
            $this->UsuarioId = $UsuarioId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Documento = $Documento;
            $this->Nome = $Nome;
        }

        if($this->UsuarioAplicacaoId > 0) {
            $this->Usuario = $pdo->GetById("Usuario", "UsuarioId", $this->UsuarioId, "DAL\\Usuario");

            $Perfis = $pdo->select("SELECT * FROM UsuarioPerfil WHERE UsuarioId = ".$this->UsuarioId, "", true);
            $this->ListPerfil = "";
            for($i = 0; $i < count($Perfis); $i++){
                $this->ListPerfil .= $Perfis[$i]->PerfilId.($i ==(count($Perfis)-1) ? "" : ",");
            }

            $this->Documento = empty($this->Usuario->Pessoa->PessoaFisica->CPF) ? $this->Usuario->Pessoa->PessoaJuridica->CNPJ : $this->Usuario->Pessoa->PessoaFisica->CPF;

            //Aplicacao
            if($this->AplicacaoId > 0)
                $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }else{
            $this->Aplicacao = new Aplicacao();
            $this->Usuario = new Usuario();
            $this->Usuario->Pessoa->Nome = "Nenhum usuário encontrado";
        }


        return $this;
    }

}
