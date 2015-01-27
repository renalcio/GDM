<?php
namespace DAL;
use Libs\Database;
class Aplicacao
{
    var $AplicacaoId;
    /**
     * @Required
     * @DisplayName: Título
     */
    var $Titulo;
    /**
     * @DisplayName: Descrição
     */
    var $Descricao;
    var $PessoaId;
    var $DataCriacao;

    /**
     * @Required
     * @DisplayName: Nicho
     */
    var $NichoId;

    /**
     * @DisplayName: Pasta da Aplicação
     */
    var $Pasta;

    /**
     * @NotMapped
     */
    var $Pessoa;

    public function __construct($AplicacaoId = 0, $Titulo="", $Descricao="", $PessoaId=0, $DataCriacao="", $NichoId=0, $Pasta="")
    {
        $pdo = new Database();
        if(!empty($Titulo)) {
            $this->AplicacaoId = $AplicacaoId;
            $this->Titulo = $Titulo;
            $this->Descricao = $Descricao;
            $this->PessoaId = $PessoaId;
            $this->DataCriacao = $DataCriacao;
            $this->NichoId = $NichoId;
            $this->Pasta = $Pasta;
        }

        if($this->AplicacaoId > 0 && $this->PessoaId) {

            $this->Pessoa = $pdo->GetById("Pessoa", "PessoaId", $this->PessoaId, "DAL\\Pessoa");


        }
        else {
            $this->Pessoa = new Pessoa();
        }

        return $this;
    }

}