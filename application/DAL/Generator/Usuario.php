<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Usuario
{
    /**
                     * @PrimaryKey
                     * @Name: UsuarioId
                     * @Type: int(255)
                     */
 var $UsuarioId = 0;

/**
                 * @Name: Login
                 * @Type: varchar(255)
                 */
 var $Login;

/**
                 * @Name: Senha
                 * @Type: varchar(255)
                 */
 var $Senha;

/**
                 * @Name: PessoaId
                 * @Type: int(255)
                 */
 var $PessoaId = 0;

/**
                 * @Name: Avatar
                 * @Type: text
                 */
 var $Avatar;


    function __construct($UsuarioId = "",$Login = "",$Senha = "",$PessoaId = "",$Avatar = ""){
        

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
