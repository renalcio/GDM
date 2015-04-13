<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 13/04/2015 11:47:07
 */

namespace DAL;

use Libs\UnitofWork;

class MensagemPessoa
{
    /**
     * @PrimaryKey
     * @Name: MensagemPessoaId
     * @DisplayName: MensagemPessoaId
     * @Type: int(11)
     */
    var $MensagemPessoaId = 0;

    /**
     * @Name: MensagemId
     * @DisplayName: MensagemId
     * @Type: int(11)
     */
    var $MensagemId = 0;

    /**
     * @Name: PessoaId
     * @DisplayName: Destinatário
     * @Type: int(11)
     */
    var $PessoaId = 0;

    /**
     * @Name: DataLeitura
     * @DisplayName: Data de Visualização
     * @Type: varchar(255)
     */
    var $DataLeitura;

    /**
     * @Name: Copia
     * @DisplayName: Tipo de Envio
     */
    var $Copia = 0;

    /**
     * @NotMapped
     */
    var $Pessoa;

    /**
     * @NotMapped
     */
    var $Apagado;

    function __construct($MensagemPessoaId = "",$MensagemId = "",$PessoaId = "",$DataLeitura = "",$Copia = ""){


        $unitofwork = new UnitofWork();

        if(!empty($MensagemId)){

            $this->MensagemPessoaId = $MensagemPessoaId;
            $this->MensagemId = $MensagemId;
            $this->PessoaId = $PessoaId;
            $this->DataLeitura = $DataLeitura;
            $this->Copia = $Copia;

        }

        if(!empty($this->MensagemPessoaId)){

            //Virtuais e Referencias
            if(!empty($this->PessoaId)){
                $this->Pessoa = $unitofwork->GetById(new Pessoa(), $this->PessoaId);
            }

        }

    }
}
