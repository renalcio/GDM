<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Permissao
{
    /**
                     * @PrimaryKey
                     * @Name: PermissaoId
                     * @Type: int(11)
                     */
 var $PermissaoId = 0;

/**
                 * @Name: MenuId
                 * @Type: int(11)
                 */
 var $MenuId = 0;

/**
                 * @Name: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: PerfilId
                 * @Type: int(11)
                 */
 var $PerfilId = 0;


    function __construct($PermissaoId = "",$MenuId = "",$AplicacaoId = "",$PerfilId = ""){
        

        if(!empty($MenuId)){
        
  $this->PermissaoId = $PermissaoId;
  $this->MenuId = $MenuId;
  $this->AplicacaoId = $AplicacaoId;
  $this->PerfilId = $PerfilId;

        }
        
 if(!empty($this->PermissaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
