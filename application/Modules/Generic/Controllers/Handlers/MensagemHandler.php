<?php
/**
 * Handler
 * Titulo: Mensagens
 * Autor: renalcio.freitas
 * Data: 13/04/2015
 */
namespace Modules\Generic\Controllers\Handlers;
use Core\Controller;
use DAL\Mensagem;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;

class MensagemHandler extends Controller
{
    public function GetTable($termo="", $pagina = 1, $saida = 0){
        $retorno = "";
        $totalPagina = ($pagina-1) * 50;
        $msgs = $this->unitofwork->Get(new Mensagem(), "Assunto LIKE '%".$termo."%' OR Conteudo LIKE '%".$termo."%'")->Skip($totalPagina)->Take(50)->ToList();
    }
}