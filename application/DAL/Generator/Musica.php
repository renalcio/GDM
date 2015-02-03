<?php

/**
* DAL
* @author: Gerador de Classe
* @date: 03/02/2015 14:52:07
*/

namespace DAL;

class Musica
{
    /**
                     * @PrimaryKey
                     * @Name: MusicaId
                     * @Type: int(255)
                     */
 var $MusicaId = 0;

/**
                 * @Name: ArtistaId
                 * @Type: int(255)
                 */
 var $ArtistaId = 0;

/**
                 * @Name: Titulo
                 * @Type: varchar(255)
                 */
 var $Titulo;

/**
                 * @Name: AplicacaoId
                 * @Type: int(255)
                 */
 var $AplicacaoId = 0;


    function __construct($MusicaId = "",$ArtistaId = "",$Titulo = "",$AplicacaoId = ""){
        

        if(!empty($ArtistaId)){
        
  $this->MusicaId = $MusicaId;
  $this->ArtistaId = $ArtistaId;
  $this->Titulo = $Titulo;
  $this->AplicacaoId = $AplicacaoId;

        }
        
 if(!empty($this->MusicaId)){
        
      //Virtuais e Referencias
        

        
 }
        
    }
}
