<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:13
*/

namespace DAL;

use Libs\Database;

class PessoaAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: PessoaEmpresaId
                     * @DisplayName: PessoaEmpresaId
                     * @Type: int(11)
                     */
 var $PessoaEmpresaId = 0;

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


    function __construct($PessoaEmpresaId = "",$PessoaId = "",$AplicacaoId = "",$Apagado = ""){
        

            $pdo = new Database();

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
