<?php
namespace DAL;
use Classe\Database;
class Pessoa
{
    var $PessoaId;
    var $Nome;
    var $Email;
    var $Telefone;
    var $Celular;
    var $Observacao;

    /**
     * @NotMapped
     */
    var $PessoaFisica;
    /**
     * @NotMapped
     */
    var $PessoaJuridica;
    /**
     * @NotMapped
     */
    var $TipoPessoaFisica = true;

    public function __construct($PessoaId=0, $Nome="", $Email="", $Telefone="", $Celular="", $Observacao="",
                                $TipoPessoaFisica = true)
    {
        $this->pdo = new Database();
        if(!empty($Nome)) {
            $this->PessoaId = $PessoaId;
            $this->Nome = $Nome;
            $this->Email = $Email;
            $this->Telefone = $Telefone;
            $this->Celular = $Celular;
            $this->Observacao = $Observacao;
            $this->TipoPessoaFisica = $TipoPessoaFisica;
        }

        if($this->PessoaId > 0) {

            $this->PessoaFisica = $this->pdo->GetById("PessoaFisica", "PessoaId", $this->PessoaId, "DAL\\PessoaFisica");

            $this->PessoaJuridica = $this->pdo->GetById("PessoaJuridica", "PessoaId", $this->PessoaId, "DAL\\PessoaJuridica");

                if($this->PessoaJuridica == null)
                    $this->TipoPessoaFisica = true;
                else
                    $this->TipoPessoaFisica = false;
        }
        else {
            $this->PessoaFisica = new PessoaFisica($PessoaId);
            $this->PessoaJuridica = new PessoaFisica($PessoaId);
        }

        return $this;
    }

}

class PessoaFisica
{
    var $PessoaId;
    var $CPF;
    var $Nascimento;
    var $RG;
    var $EstadoCivil;
    var $Nacionalidade;
    var $Sexo;

    public function __construct($PessoaId = 0, $CPF = "", $Nascimento = "", $RG="", $EstadoCivil="", $Nacionalidade="", $Sexo="")
    {
        if(!empty($CPF)) {
            $this->PessoaId = $PessoaId;
            $this->CPF = $CPF;
            $this->Nascimento = $Nascimento;
            $this->RG = $RG;
            $this->EstadoCivil = $EstadoCivil;
            $this->Nacionalidade = $Nacionalidade;
            $this->Sexo = $Sexo;
        }
        return $this;
    }
}

class PessoaJuridica
{
    var $PessoaId;
    var $NomeFantasia;
    var $IE;
    var $IM;
    var $CNPJ;

    public function __construct($PessoaId=0, $CNPJ="", $NomeFantasia="", $IE="", $IM="")
    {
        if(!empty($CNPJ)) {
            $this->Pessoaid = $PessoaId;
            $this->NomeFantasia = $NomeFantasia;
            $this->IE = $IE;
            $this->IM = $IM;
            $this->CNPJ = $CNPJ;
        }

        return $this;
    }
}