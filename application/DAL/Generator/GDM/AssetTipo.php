<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 09/04/2015 19:52:38
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
