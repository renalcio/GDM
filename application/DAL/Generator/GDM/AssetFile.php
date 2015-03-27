<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 27/03/2015 15:44:10
*/

namespace DAL;

use Libs\UnitofWork;

class AssetFile
{
    /**
                     * @PrimaryKey
                     * @Name: AssetFileId
                     * @DisplayName: AssetFileId
                     * @Type: int(11)
                     */
 var $AssetFileId = 0;

/**
                 * @Name: AssetId
                 * @DisplayName: AssetId
                 * @Type: int(11)
                 */
 var $AssetId = 0;

/**
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

/**
                 * @Name: Url
                 * @DisplayName: Url
                 * @Type: varchar(255)
                 */
 var $Url;


    function __construct($AssetFileId = "",$AssetId = "",$AssetTipoId = "",$Titulo = "",$Url = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($AssetId)){
            
  $this->AssetFileId = $AssetFileId;
  $this->AssetId = $AssetId;
  $this->AssetTipoId = $AssetTipoId;
  $this->Titulo = $Titulo;
  $this->Url = $Url;

        }
        
 if(!empty($this->AssetFileId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
