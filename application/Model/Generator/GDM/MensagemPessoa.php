<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

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
                 * @DisplayName: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;

/**
                 * @Name: DataLeitura
                 * @DisplayName: DataLeitura
                 * @Type: bigint(20)
                 */
 var $DataLeitura = 0;

/**
                 * @Name: Copia
                 * @DisplayName: Copia
                 * @Type: tinyint(4)
                 */
 var $Copia = 0;

/**
                 * @Name: Encaminhamento
                 * @DisplayName: Encaminhamento
                 * @Type: tinyint(1)
                 */
 var $Encaminhamento = 0;

/**
                 * @Name: RespostaId
                 * @DisplayName: RespostaId
                 * @Type: int(11)
                 */
 var $RespostaId = 0;

/**
                 * @Name: Apagada
                 * @DisplayName: Apagada
                 * @Type: tinyint(1)
                 */
 var $Apagada = 0;

/**
                 * @Name: Lida
                 * @DisplayName: Lida
                 * @Type: tinyint(1)
                 */
 var $Lida = 0;


    function __construct($MensagemPessoaId = "",$MensagemId = "",$PessoaId = "",$DataLeitura = "",$Copia = "",$Encaminhamento = "",$RespostaId = "",$Apagada = "",$Lida = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($MensagemId)){
            
  $this->MensagemPessoaId = $MensagemPessoaId;
  $this->MensagemId = $MensagemId;
  $this->PessoaId = $PessoaId;
  $this->DataLeitura = $DataLeitura;
  $this->Copia = $Copia;
  $this->Encaminhamento = $Encaminhamento;
  $this->RespostaId = $RespostaId;
  $this->Apagada = $Apagada;
  $this->Lida = $Lida;

        }
        
 if(!empty($this->MensagemPessoaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
