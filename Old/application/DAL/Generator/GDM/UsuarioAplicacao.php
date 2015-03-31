<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 27/03/2015 15:44:11
*/

namespace DAL;

use Libs\UnitofWork;

class UsuarioAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioAplicacaoId
                     * @DisplayName: UsuarioAplicacaoId
                     * @Type: int(11)
                     */
 var $UsuarioAplicacaoId = 0;

/**
                 * @Name: UsuarioId
                 * @DisplayName: UsuarioId
                 * @Type: int(11)
                 */
 var $UsuarioId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Ativo
                 * @DisplayName: Ativo
                 * @Type: tinyint(4)
                 */
 var $Ativo = 0;


    function __construct($UsuarioAplicacaoId = "",$UsuarioId = "",$AplicacaoId = "",$Ativo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($UsuarioId)){
            
  $this->UsuarioAplicacaoId = $UsuarioAplicacaoId;
  $this->UsuarioId = $UsuarioId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Ativo = $Ativo;

        }
        
 if(!empty($this->UsuarioAplicacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
