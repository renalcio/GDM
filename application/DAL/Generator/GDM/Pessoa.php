<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:13
*/

namespace DAL;

use Libs\Database;

class Pessoa
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaId
                     * @DisplayName: PessoaId
                     * @Type: int(255)
                     */
 var $PessoaId = 0;

/**
                 * @Name: Nome
                 * @DisplayName: Nome
                 * @Type: varchar(255)
                 */
 var $Nome;

/**
                 * @Name: Email
                 * @DisplayName: Email
                 * @Type: varchar(255)
                 */
 var $Email;

/**
                 * @Name: Telefone
                 * @DisplayName: Telefone
                 * @Type: varchar(50)
                 */
 var $Telefone;

/**
                 * @Name: Celular
                 * @DisplayName: Celular
                 * @Type: varchar(50)
                 */
 var $Celular;

/**
                 * @Name: Observacao
                 * @DisplayName: Observacao
                 * @Type: text
                 */
 var $Observacao;


    function __construct($PessoaId = "",$Nome = "",$Email = "",$Telefone = "",$Celular = "",$Observacao = ""){
        

            $pdo = new Database();

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
