<?php
namespace DAL;
use Classe\Database;
class UsuarioAplicacao
{
    var $UsuarioId;
    /**
     * @Required
     * @DisplayName: Aplicação
     */
    var $AplicacaoId;

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
     * @DisplayName: CPF/CNPJ
     */
    var $Documento;
    var $Nome;

    /**
     * @NotMapped
     */
    var $Aplicacao;

    public function __construct($UsuarioId=0, $AplicacaoId = 0, $Documento="", $Nome="")
    {
        $pdo = new Database();
        if(!empty($Login)) {
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

            //Aplicacao
            if($this->AplicacaoId > 0)
                $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }


        return $this;
    }

}
