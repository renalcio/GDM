<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 13/04/2015 11:47:07
 */

namespace DAL;

use Libs\UnitofWork;

class Mensagem
{
    /**
     * @PrimaryKey
     * @Name: MensagemId
     * @DisplayName: MensagemId
     * @Type: int(11)
     */
    var $MensagemId = 0;

    /**
     * @Name: PessoaId
     * @DisplayName: Remetente
     * @Type: int(11)
     */
    var $PessoaId = 0;

    /**
     * @Name: Assunto
     * @DisplayName: Assunto
     * @Type: varchar(255)
     */
    var $Assunto;

    /**
     * @Name: Conteudo
     * @DisplayName: Conteúdo
     * @Type: text
     */
    var $Conteudo;

    /**
     * @Name: DataEnvio
     * @DisplayName: Data de Envio
     */
    var $DataEnvio;

    /**
     * @NotMapped
     */
    var $Pessoa;

    /**
     * @NotMapped
     */
    var $ListPara;

    /**
     * @NotMapped
     */
    var $Para;

    /**
     * @NotMapped
     */
    var $Copia;

    /**
     * @NotMapped
     */
    var $Encaminhamento;

    /**
     * @NotMapped
     */
    var $RespostaId;



    function __construct($MensagemId = "",$PessoaId = "",$Assunto = "",$Conteudo = "",$DataEnvio = "",$Apagada = ""){


        $unitofwork = new UnitofWork();

        if(!empty($PessoaId)){

            $this->MensagemId = $MensagemId;
            $this->PessoaId = $PessoaId;
            $this->Assunto = $Assunto;
            $this->Conteudo = $Conteudo;
            $this->DataEnvio = $DataEnvio;
            $this->Apagada = $Apagada;

        }

        if(!empty($this->MensagemId)){

            //Virtuais e Referencias
            if(!empty($this->PessoaId)){
                $this->Pessoa = $unitofwork->GetById(new Pessoa(), $this->PessoaId);
            }

            //$this->ListPara = $unitofwork->Get(new MensagemPessoa(), "MensagemId = '".$this->MensagemId."'")->ToList();

        }

    }
}
