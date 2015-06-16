<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class PessoaJuridica
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @DisplayName: PessoaId
                     * @Type: int(11)
                     */
 var $PessoaId = 0;

/**
                 * @Name: NomeFantasia
                 * @DisplayName: NomeFantasia
                 * @Type: varchar(255)
                 */
 var $NomeFantasia;

/**
                 * @Name: IE
                 * @DisplayName: IE
                 * @Type: varchar(50)
                 */
 var $IE;

/**
                 * @Name: IM
                 * @DisplayName: IM
                 * @Type: varchar(50)
                 */
 var $IM;

/**
                 * @Name: CNPJ
                 * @DisplayName: CNPJ
                 * @Type: varchar(50)
                 */
 var $CNPJ;


    function __construct($PessoaId = "",$NomeFantasia = "",$IE = "",$IM = "",$CNPJ = ""){
        

            $unitofwork = new UnitofWork();

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
