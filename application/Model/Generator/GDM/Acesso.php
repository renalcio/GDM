<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class Acesso
{
    /**
                     * @PrimaryKey
                     * @Name: AcessoId
                     * @DisplayName: AcessoId
                     * @Type: int(11)
                     */
 var $AcessoId = 0;

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

/**
                 * @Name: MenuId
                 * @DisplayName: MenuId
                 * @Type: int(11)
                 */
 var $MenuId = 0;


    function __construct($AcessoId = "",$AplicacaoId = "",$PerfilId = "",$MenuId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AplicacaoId)){
            
  $this->AcessoId = $AcessoId;
  $this->AplicacaoId = $AplicacaoId;
  $this->PerfilId = $PerfilId;
  $this->MenuId = $MenuId;

        }
        
 if(!empty($this->AcessoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
