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

        if($this->AplicacaoId > 0) {

            //$this->PessoaFisica = $this->pdo->GetById("PessoaFisica", "PessoaId", $this->PessoaId, "DAL\\PessoaFisica"); GET OBJETOS INTERNOS


        }
        else {
            //$this->PessoaFisica = new PessoaFisica($PessoaId); NEW OBJETOS INTERNOS
        }

        return $this;
    }

}