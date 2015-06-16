<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class PessoaAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaAplicacaoId
                     * @DisplayName: PessoaAplicacaoId
                     * @Type: int(11)
                     */
 var $PessoaAplicacaoId = 0;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(11)
                 */
 var $PessoaId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Apagado
                 * @DisplayName: Apagado
                 * @Type: tinyint(4)
                 */
 var $Apagado = 0;


    function __construct($PessoaAplicacaoId = "",$PessoaId = "",$AplicacaoId = "",$Apagado = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($PessoaId)){
            
  $this->PessoaAplicacaoId = $PessoaAplicacaoId;
  $this->PessoaId = $PessoaId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Apagado = $Apagado;

        }
        
 if(!empty($this->PessoaAplicacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
