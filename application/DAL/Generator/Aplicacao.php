<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Aplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: AplicacaoId
                     * @Type: int(255)
                     */
 var $AplicacaoId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: Descricao
                 * @Type: text
                 */
 var $Descricao;

/**
                 * @Name: PessoaId
                 * @Type: int(255)
                 */
 var $PessoaId = 0;

/**
                 * @Name: DataCriacao
                 * @Type: varchar(50)
                 */
 var $DataCriacao;

/**
                 * @Name: NichoId
                 * @Type: int(255)
                 */
 var $NichoId = 0;

/**
                 * @Name: Pasta
                 * @Type: varchar(255)
                 */
 var $Pasta;


    function __construct($AplicacaoId = "",$Titulo = "",$Descricao = "",$PessoaId = "",$DataCriacao = "",$NichoId = "",$Pasta = ""){
        

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
