<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 05/02/2015 14:07:04
*/

namespace DAL;

use Libs\Database;

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
        

            $pdo = new Database();

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
