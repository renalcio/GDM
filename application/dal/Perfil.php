<?php
namespace DAL;
use Classe\Database;
class Perfil
{
    var $PerfilId;
    var $AplicacaoId;
    var $Titulo;
    var $Ativo;

    /**
     * @NotMapped
     */
    var $Acessos;

    /**
     * @NotMapped
     */
    var $Aplicacao;

    public function __construct($PerfilId = 0, $AplicacaoId = 0, $Titulo="", $Ativo = 1, $Acessos = Array())
    {
        $pdo = new Database();
        if(!empty($Titulo)) {
            $this->PerfilId = $PerfilId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Titulo = $Titulo;
            $this->Ativo = $Ativo;
            $this->Acessos = $Acessos;
        }

        if($this->PerfilId > 0) {
            $this->Acessos = $pdo->select("SELECT * FROM Acesso WHERE PerfilId ='".$this->PerfilId."'", "", true);
            $this->Aplicacao = $pdo->GetById("Aplicacao", "AplicacaoId", $this->AplicacaoId, "DAL\\Aplicacao");
        }
        else {
            $this->Aplicacao = new Aplicacao;
        }

        return $this;
    }

}