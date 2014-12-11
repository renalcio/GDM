<?php
namespace DAL;
use Classe\Database;
class Aplicacao
{
    var $AplicacaoId;
    var $Titulo;
    var $Descricao;
    var $PessoaId;
    var $DataCriacao;
    var $NichoId;

    /**
     * @NotMapped
     */
    var $Pessoa;
    /**
     * @NotMapped
     */
    var $ListNicho;
    /**
     * @NotMapped
     */
    var $Nicho;

    public function __construct($AplicacaoId = 0, $Titulo="", $Descricao="", $PessoaId=0, $DataCriacao="", $NichoId=0)
    {
        $this->pdo = new Database();
        if(!empty($Titulo)) {
            $this->AplicacaoId = $AplicacaoId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->PessoaId = $PessoaId;
            $this->DataCriacao = $DataCriacao;
            $this->NichoId = $NichoId;
        }

        if($this->AplicacaoId > 0 && $this->PessoaId) {

            $this->Pessoa = $this->pdo->GetById("Pessoa", "PessoaId", $this->PessoaId, "DAL\\Pessoa");


        }
        else {
            $this->Pessoa = new Pessoa();
        }

        return $this;
    }

}