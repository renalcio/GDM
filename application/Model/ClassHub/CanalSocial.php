<?php

/**
* Model
* @author: Gerador de Classe
* @date: 20/04/2015 12:10:37
*/

namespace Model\ClassHub;

use Libs\UnitofWork;

class CanalSocial
{
    /**
                     * @PrimaryKey
                     * @Name: CanalSocialId
                     * @DisplayName: CanalSocialId
                     * @Type: int(11)
                     */
 var $CanalSocialId = 0;

/**
                 * @Name: TurmaId
                 * @DisplayName: TurmaId
                 * @Type: int(11)
                 */
 var $TurmaId = 0;

/**
                 * @Name: Tipo
                 * @DisplayName: Tipo
                 * @Type: varchar(255)
                 */
 var $Tipo;

/**
                 * @Name: Url
                 * @DisplayName: Url
                 * @Type: varchar(255)
                 */
 var $Url;


    function __construct($CanalSocialId = "",$TurmaId = "",$Tipo = "",$Url = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($TurmaId)){
            
  $this->CanalSocialId = $CanalSocialId;
  $this->TurmaId = $TurmaId;
  $this->Tipo = $Tipo;
  $this->Url = $Url;

        }
        
 if(!empty($this->CanalSocialId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
