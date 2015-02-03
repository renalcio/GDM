<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:06
*/

namespace DAL;

class Acesso
{
    /**
                     * @PrimaryKey
                     * @Name: AcessoId
                     * @Type: int(11)
                     */
 var $AcessoId = 0;

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

/**
                 * @Name: MenuId
                 * @Type: int(11)
                 */
 var $MenuId = 0;


    function __construct($AcessoId = "",$AplicacaoId = "",$PerfilId = "",$MenuId = ""){
        

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
