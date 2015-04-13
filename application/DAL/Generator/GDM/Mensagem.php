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
                 * @Type: varchar(255)
                 */
 var $DataEnvio;

/**
                 * @Name: Apagada
                 * @DisplayName: Apagada
                 * @Type: tinyint(4)
                 */
 var $Apagada = 0;


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
        

        
 }
        
    }
}
