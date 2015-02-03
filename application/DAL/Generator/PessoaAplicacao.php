<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class PessoaAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaEmpresaId
                     * @Type: int(11)
                     */
 var $PessoaEmpresaId = 0;

/**
                 * @Name: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Apagado
                 * @Type: tinyint(4)
                 */
 var $Apagado = 0;


    function __construct($PessoaEmpresaId = "",$PessoaId = "",$AplicacaoId = "",$Apagado = ""){
        

        if(!empty($PessoaId)){
        
  $this->PessoaEmpresaId = $PessoaEmpresaId;
  $this->PessoaId = $PessoaId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Apagado = $Apagado;

        }
        
 if(!empty($this->PessoaEmpresaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
