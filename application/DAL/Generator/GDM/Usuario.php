<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 10/02/2015 15:04:14
*/

namespace DAL;

use Libs\Database;

class Usuario
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioId
                     * @DisplayName: UsuarioId
                     * @Type: int(255)
                     */
 var $UsuarioId = 0;

/**
                 * @Name: Login
                 * @DisplayName: Login
                 * @Type: varchar(255)
                 */
 var $Login;

/**
                 * @Name: Senha
                 * @DisplayName: Senha
                 * @Type: varchar(255)
                 */
 var $Senha;

/**
                 * @Name: PessoaId
                 * @DisplayName: PessoaId
                 * @Type: int(255)
                 */
 var $PessoaId = 0;

/**
                 * @Name: Avatar
                 * @DisplayName: Avatar
                 * @Type: text
                 */
 var $Avatar;


    function __construct($UsuarioId = "",$Login = "",$Senha = "",$PessoaId = "",$Avatar = ""){
        

            $pdo = new Database();

            if(!empty($Login)){
            
  $this->UsuarioId = $UsuarioId;
  $this->Login = $Login;
  $this->Senha = $Senha;
  $this->PessoaId = $PessoaId;
  $this->Avatar = $Avatar;

        }
        
 if(!empty($this->UsuarioId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
