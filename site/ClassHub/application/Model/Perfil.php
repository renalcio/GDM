<?php
namespace Model;
use Libs\Database;
use Libs\UnitofWork;

class Perfil
{
    /**
     * @PrimaryKey
     */
    var $PerfilId;
    var $AplicacaoId;
    var $Titulo;
    var $Ativo;
    var $Nivel;

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
        $pdo = new UnitofWork();
        if(!empty($Titulo)) {
            $this->PerfilId = $PerfilId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Titulo = $Titulo;
            $this->Ativo = $Ativo;
            $this->Acessos = $Acessos;
        }

        if($this->PerfilId > 0) {
            $this->Acessos = $pdo->pdo->select("SELECT * FROM Acesso WHERE PerfilId ='".$this->PerfilId."'", "", true);
            $this->Aplicacao = $pdo->GetById(new Aplicacao(), $this->AplicacaoId);
        }
        else {
            $this->Aplicacao = new Aplicacao;
        }

        return $this;
    }

}