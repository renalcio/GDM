<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 13/04/2015 11:47:07
*/

namespace DAL;

use Libs\UnitofWork;

class Permissao
{
    /**
                     * @PrimaryKey
                     * @Name: PermissaoId
                     * @DisplayName: PermissaoId
                     * @Type: int(11)
                     */
 var $PermissaoId = 0;

/**
                 * @Name: MenuId
                 * @DisplayName: MenuId
                 * @Type: int(11)
                 */
 var $MenuId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: PerfilId
                 * @DisplayName: PerfilId
                 * @Type: int(11)
                 */
 var $PerfilId = 0;


    function __construct($PermissaoId = "",$MenuId = "",$AplicacaoId = "",$PerfilId = ""){
        

            $unitofwork = new UnitofWork();

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
