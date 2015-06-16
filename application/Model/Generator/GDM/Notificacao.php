<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 16/06/2015 17:15:19
*/

namespace Model;

use Libs\UnitofWork;

class Notificacao
{
    /**
                     * @PrimaryKey
                     * @Name: NotificacaoId
                     * @DisplayName: NotificacaoId
                     * @Type: int(11)
                     */
 var $NotificacaoId = 0;

/**
                 * @Name: AplicacaoId
                 * @DisplayName: AplicacaoId
                 * @Type: int(11)
                 */
 var $AplicacaoId = 0;

/**
                 * @Name: Conteudo
                 * @DisplayName: Conteudo
                 * @Type: varchar(255)
                 */
 var $Conteudo;

/**
                 * @Name: Icone
                 * @DisplayName: Icone
                 * @Type: varchar(255)
                 */
 var $Icone;

/**
                 * @Name: Classe
                 * @DisplayName: Classe
                 * @Type: varchar(255)
                 */
 var $Classe;

/**
                 * @Name: Data
                 * @DisplayName: Data
                 * @Type: varchar(255)
                 */
 var $Data;


    function __construct($NotificacaoId = "",$AplicacaoId = "",$Conteudo = "",$Icone = "",$Classe = "",$Data = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AplicacaoId)){
            
  $this->NotificacaoId = $NotificacaoId;
  $this->AplicacaoId = $AplicacaoId;
  $this->Conteudo = $Conteudo;
  $this->Icone = $Icone;
  $this->Classe = $Classe;
  $this->Data = $Data;

        }
        
 if(!empty($this->NotificacaoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
