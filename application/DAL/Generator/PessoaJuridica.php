<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class PessoaJuridica
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @Type: int(11)
                     */
 var $PessoaId = 0;

/**
                 * @Name: NomeFantasia
                 * @Type: varchar(255)
                 */
 var $NomeFantasia;

/**
                 * @Name: IE
                 * @Type: varchar(50)
                 */
 var $IE;

/**
                 * @Name: IM
                 * @Type: varchar(50)
                 */
 var $IM;

/**
                 * @Name: CNPJ
                 * @Type: varchar(50)
                 */
 var $CNPJ;


    function __construct($PessoaId = "",$NomeFantasia = "",$IE = "",$IM = "",$CNPJ = ""){
        

        if(!empty($NomeFantasia)){
        
  $this->PessoaId = $PessoaId;
  $this->NomeFantasia = $NomeFantasia;
  $this->IE = $IE;
  $this->IM = $IM;
  $this->CNPJ = $CNPJ;

        }
        
 if(!empty($this->PessoaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
