<?php
/**
 * Handler
 * Titulo: Mensagens
 * Autor: renalcio.freitas
 * Data: 13/04/2015
 */
namespace Modules\Generic\Controllers\Handlers;
use Core\Controller;
use Model\Mensagem;
use Model\MensagemPessoa;
use Model\Notificacao;
use Libs\Database;
use Libs\Helper;
use Libs\ListHelper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;

class NotificacaoHandler extends Controller
{
    public function GetIndex(){
        header('Content-Type: application/json; Charset=UTF-8');
        $retorno = new \stdClass();
        $sql = $this->unitofwork->Get(new \Model\Notificacao(), "AplicacaoId = '".APPID."' AND (Data = '".\Libs\Datetime::Hoje("d/m/Y")."' OR Data = '' OR Data IS NULL)")->ToList();

        $retorno->Count = $sql->Count();
        $retorno->HtmlDrop = "";
        $retorno->HtmlModal = "";
        if($sql->Count() > 0) {

            $sql->For_Each(function ($item, $i) use($retorno) {
                if($i <= 9){
                $retorno->HtmlDrop .= '<li>
                    <a href="#">
                        <i class="fa ' . $item->Icone . ' ' . $item->Classe . '"></i>
                                                ' . $item->Conteudo . '
                    </a>
                </li>';
            }
                $retorno->HtmlModal .= '
<tr>
                                                <td width="12px" align="center"></td>
                                                <td width="24px" align="center"> <i class="fa '.$item->Icone.' '.$item->Classe.'"></i></td>
                                                <td>'.$item->Conteudo.'</td>
                                            </tr>';
            });
        }else{
            $retorno->HtmlDrop = '<li><a href="#"><p>Nenhuma Notificação</p></a></li>';
            $retorno->HtmlModal = '<tr><td colspan="3" align="center">Nenhuma notificação</td></tr>';
        }

        echo json_encode($retorno);
    }
}