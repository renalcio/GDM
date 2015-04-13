<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 13/04/2015 11:47:07
*/

namespace DAL;

use Libs\UnitofWork;

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

/**
                 * @Name: DbHost
                 * @DisplayName: DbHost
                 * @Type: varchar(255)
                 */
 var $DbHost;

/**
                 * @Name: DbSenha
                 * @DisplayName: DbSenha
                 * @Type: varchar(255)
                 */
 var $DbSenha;

/**
                 * @Name: DbUsuario
                 * @DisplayName: DbUsuario
                 * @Type: varchar(255)
                 */
 var $DbUsuario;

/**
                 * @Name: DbBanco
                 * @DisplayName: DbBanco
                 * @Type: varchar(255)
                 */
 var $DbBanco;


    function __construct($AplicacaoId = "",$Titulo = "",$Descricao = "",$PessoaId = "",$DataCriacao = "",$NichoId = "",$Pasta = "",$DbHost = "",$DbSenha = "",$DbUsuario = "",$DbBanco = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->AplicacaoId = $AplicacaoId;
  $this->Titulo = $Titulo;
  $this->Descricao = $Descricao;
  $this->PessoaId = $PessoaId;
  $this->DataCriacao = $DataCriacao;
  $this->NichoId = $NichoId;
  $this->Pasta = $Pasta;
  $this->DbHost = $DbHost;
  $this->DbSenha = $DbSenha;
  $this->DbUsuario = $DbUsuario;
  $this->DbBanco = $DbBanco;

        }
        
 if(!empty($this->AplicacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
