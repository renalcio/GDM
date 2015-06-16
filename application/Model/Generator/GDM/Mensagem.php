<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

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
                 * @DisplayName: PessoaId
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
                 * @DisplayName: Conteudo
                 * @Type: text
                 */
 var $Conteudo;

/**
                 * @Name: DataEnvio
                 * @DisplayName: DataEnvio
                 * @Type: bigint(20)
                 */
 var $DataEnvio = 0;


    function __construct($MensagemId = "",$PessoaId = "",$Assunto = "",$Conteudo = "",$DataEnvio = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($PessoaId)){
            
  $this->MensagemId = $MensagemId;
  $this->PessoaId = $PessoaId;
  $this->Assunto = $Assunto;
  $this->Conteudo = $Conteudo;
  $this->DataEnvio = $DataEnvio;

        }
        
 if(!empty($this->MensagemId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
