<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 09/04/2015 19:52:38
*/

namespace DAL;

use Libs\UnitofWork;

class AssetDependencia
{
    /**
                     * @PrimaryKey
                     * @Name: AssetDependenciaId
                     * @DisplayName: AssetDependenciaId
                     * @Type: int(11)
                     */
 var $AssetDependenciaId = 0;

/**
                 * @Name: AssetId
                 * @DisplayName: AssetId
                 * @Type: int(11)
                 */
 var $AssetId = 0;

/**
                 * @Name: AssetPaiId
                 * @DisplayName: AssetPaiId
                 * @Type: int(11)
                 */
 var $AssetPaiId = 0;


    function __construct($AssetDependenciaId = "",$AssetId = "",$AssetPaiId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AssetId)){
            
  $this->AssetDependenciaId = $AssetDependenciaId;
  $this->AssetId = $AssetId;
  $this->AssetPaiId = $AssetPaiId;

        }
        
 if(!empty($this->AssetDependenciaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
