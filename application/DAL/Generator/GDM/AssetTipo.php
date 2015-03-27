<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 27/03/2015 15:44:10
*/

namespace DAL;

use Libs\UnitofWork;

class AssetTipo
{
    /**
                     * @PrimaryKey
                     * @Name: AssetTipoId
                     * @DisplayName: AssetTipoId
                     * @Type: int(11)
                     */
 var $AssetTipoId = 0;

/**
                 * @Name: Titulo
                 * @DisplayName: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;


    function __construct($AssetTipoId = "",$Titulo = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($Titulo)){
            
  $this->AssetTipoId = $AssetTipoId;
  $this->Titulo = $Titulo;

        }
        
 if(!empty($this->AssetTipoId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
