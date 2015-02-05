<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 05/02/2015 14:07:02
*/

namespace DAL;

use Libs\Database;

class Aplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: AplicacaoId
                     * @DisplayName: AplicacaoId
                     * @Type: int(255)
                     */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Descricao
                 * @DisplayName: Descricao
                 * @Type: text
                 */
 var $Descricao;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(255)
                 */
 var $PessoaId = 0;

/**
                 * @Name: DataCriacao
                 * @DisplayName: DataCriacao
                 * @Type: varchar(50)
                 */
 var $DataCriacao;

/**
                 * @Name: NichoId
                 * @DisplayName: NichoId
                 * @Type: int(255)
                 */
 var $NichoId = 0;

/**
                 * @Name: Pasta
                 * @DisplayName: Pasta
                 * @Type: varchar(255)
                 */
 var $Pasta;


    function __construct($AplicacaoId = "",$Titulo = "",$Descricao = "",$PessoaId = "",$DataCriacao = "",$NichoId = "",$Pasta = ""){
        

            $pdo = new Database();

            if(!empty($Titulo)){
            
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;
  $this->PessoaId = $PessoaId;
  $this->DataCriacao = $DataCriacao;
  $this->NichoId = $NichoId;
  $this->Pasta = $Pasta;

        }
        
 if(!empty($this->AplicacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
