<?php

/**
 * DAL
 * @author: Gerador de Classe
 * @date: 09/04/2015 19:52:39
 */

namespace DAL;

use Libs\UnitofWork;

class Notificacao
{
    /**
     * @PrimaryKey
     * @Name: NotificacaoId
     * @DisplayName: NotificacaoId
     * @Type: int(11)
     */
    var $NotificacaoId = 0;

    /**
     * @Name: AplicacaoId
     * @DisplayName: Aplicação
     * @Type: int(11)
     */
    var $AplicacaoId = 0;

    /**
     * @Name: Conteudo
     * @DisplayName: Conteúdo
     * @Type: varchar(255)
     */
    var $Conteudo;

    /**
     * @Name: Icone
     * @DisplayName: Icone
     * @Type: varchar(255)
     */
    var $Icone;

    /**
     * @Name: Classe
     * @DisplayName: Tipo
     * @Type: varchar(255)
     */
    var $Classe;

    /**
     * @Name: Data
     * @DisplayName: Data
     * @Type: varchar(255)
     */
    var $Data;

    /**
     * @NotMapped
     */
    var $Aplicacao;


    function __construct($NotificacaoId = "",$AplicacaoId = "",$Conteudo = "",$Icone = "",$Classe = "",$Data = ""){


        $unitofwork = new UnitofWork();

        if(!empty($AplicacaoId)){

            $this->NotificacaoId = $NotificacaoId;
            $this->AplicacaoId = $AplicacaoId;
            $this->Conteudo = $Conteudo;
            $this->Icone = $Icone;
            $this->Classe = $Classe;
            $this->Data = $Data;

        }

        if(!empty($this->NotificacaoId)){

            //Virtuais e Referencias
            if(!empty($this->AplicacaoId))
                $this->Aplicacao = $unitofwork->GetById(new Aplicacao(), $this->AplicacaoId);


        }

    }
}
