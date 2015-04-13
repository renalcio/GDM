<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 13/04/2015 11:47:08
*/

namespace DAL;

use Libs\UnitofWork;

class UsuarioPerfil
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioPerfilId
                     * @DisplayName: UsuarioPerfilId
                     * @Type: int(255)
                     */
 var $UsuarioPerfilId = 0;

/**
                 * @Name: PerfilId
                 * @DisplayName: PerfilId
                 * @Type: int(255)
                 */
 var $PerfilId = 0;

/**
                 * @Name: UsuarioId
                 * @DisplayName: UsuarioId
                 * @Type: int(255)
                 */
 var $UsuarioId = 0;


    function __construct($UsuarioPerfilId = "",$PerfilId = "",$UsuarioId = ""){
        

            $unitofwork = new UnitofWork();

            if(!empty($PerfilId)){
            
  $this->UsuarioPerfilId = $UsuarioPerfilId;
  $this->PerfilId = $PerfilId;
  $this->UsuarioId = $UsuarioId;

        }
        
 if(!empty($this->UsuarioPerfilId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
