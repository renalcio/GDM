<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:08
*/

namespace DAL;

class UsuarioAplicacao
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioAplicacaoId
                     * @Type: int(11)
                     */
 var $UsuarioAplicacaoId = 0;

/**
                 * @Name: UsuarioId
                 * @Type: int(11)
                 */
 var $UsuarioId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Ativo
                 * @Type: tinyint(4)
                 */
 var $Ativo = 0;


    function __construct($UsuarioAplicacaoId = "",$UsuarioId = "",$AplicacaoId = "",$Ativo = ""){
        

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
