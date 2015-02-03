<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Pessoa
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @Type: int(255)
                     */
 var $PessoaId = 0;

/**
                 * @Name: Nome
                 * @Type: varchar(255)
                 */
 var $Nome;

/**
                 * @Name: Email
                 * @Type: varchar(255)
                 */
 var $Email;

/**
                 * @Name: Telefone
                 * @Type: varchar(50)
                 */
 var $Telefone;

/**
                 * @Name: Celular
                 * @Type: varchar(50)
                 */
 var $Celular;

/**
                 * @Name: Observacao
                 * @Type: text
                 */
 var $Observacao;


    function __construct($PessoaId = "",$Nome = "",$Email = "",$Telefone = "",$Celular = "",$Observacao = ""){
        

        if(!empty($Nome)){
        
  $this->PessoaId = $PessoaId;
  $this->Nome = $Nome;
  $this->Email = $Email;
  $this->Telefone = $Telefone;
  $this->Celular = $Celular;
  $this->Observacao = $Observacao;

        }
        
 if(!empty($this->PessoaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
