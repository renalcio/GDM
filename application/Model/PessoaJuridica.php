<?php

/**
* Model
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:13
*/

namespace Model;

use Libs\Database;

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
        

            $pdo = new Database();

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
