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
use DAL\MensagemPessoa;
use Libs\Database;
use Libs\Helper;
use Libs\ListHelper;
use Libs\UnitofWork;
use Libs\UsuarioHelper;

class MensagemHandler extends Controller
{
    public function GetTable($pagina = 1, $saida = 0, $lixeira = 0,$termo=""){
        //echo "Pagina: ".$pagina;
        //echo "Saida: ".$saida;
        $retorno = "";
        $totalPagina = ($pagina-1) * 50;
        $UsuarioId = UsuarioHelper::GetUsuarioPessoaId();
        $msgs = new ListHelper();
        if($saida == 0) {
            $msgs = $this->unitofwork->Get(new Mensagem(), "m.Assunto LIKE '%" . $termo . "%' OR m.Conteudo LIKE '%" . $termo . "%'")->Join($this->unitofwork->Get(new MensagemPessoa(), "mp.PessoaId = '" . $UsuarioId . "' AND mp.Apagada = '" . $lixeira . "'"), "m.MensagemId", "mp.MensagemId")->Select("mp", new MensagemPessoa())->Skip($totalPagina)->Take(50)->ToList();
        }else{
            $msgs = $this->unitofwork->Get(new Mensagem(), "(m.Assunto LIKE '%" . $termo . "%' OR m.Conteudo LIKE '%" . $termo . "%') AND m.PessoaId = '".$UsuarioId."' ")->Join($this->unitofwork->Get(new MensagemPessoa()), "m.MensagemId", "mp.MensagemId")->Select("mp", new MensagemPessoa())->Skip($totalPagina)->Take(50)->ToList();
        }

        if($msgs->Count() > 0) {
            $msgs->For_Each(function ($msg, $i) use($saida, $lixeira) {
                ?>
                <tr class="trMsgitem">
                    <? if($lixeira <= 0 && $saida <= 0){ ?>
                        <td><input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]"
                                   value="<?= $msg->MensagemPessoaId ?>"/></td>
                    <? } ?>
                    <td class="mailbox-star">
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "<b>":"");?>
                        <?
                        if(!empty($msg->RespostaId)){
                            echo '<i class="fa fa-reply"></i>';
                        }
                        else if ($msg->Copia){
                            echo '<i class="fa fa-copy"></i>';
                        }else if($msg->Encaminhamento){
                            echo '<i class="fa fa-share"></i>';
                        }
                        ?>
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "</b>":"");?>
                    </td>
                    <td class="mailbox-subject"><a href="#"onclick="Ler(<?=$msg->MensagemPessoaId ;?>)">
                            <?=(($msg->Lida <= 0 && $saida <= 0) ? "<b>":"");?>
                            <?= $msg->Mensagem->Assunto; ?>
                            <?=(($msg->Lida <= 0 && $saida <= 0) ? "</b>":"");?>
                        </a>
                    </td>
                    <td class="mailbox-name">
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "<b>":"");?>
                        <?
                        if($saida <= 0) {
                            echo Helper::Abreviar($msg->Mensagem->Pessoa->Nome);
                        }else{
                            echo Helper::Abreviar($msg->Pessoa->Nome);
                        }
                        ?>
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "</b>":"");?>
                    </td>
                    <td class="mailbox-date">
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "<b>":"");?>
                        <?= date("d/m/Y - H:i:s", $msg->Mensagem->DataEnvio); ?>
                        <?=(($msg->Lida <= 0 && $saida <= 0) ? "</b>":"");?>
                    </td>
                </tr>
            <?
            });
        }else{
            ?>
            <tr>
                <td colspan="5">Nenhum registro encontrado</td>
            </tr>
        <?
        }
    }

    public function Count(){
        header('Content-Type: application/json; Charset=UTF-8');
        $usuarioid = UsuarioHelper::GetUsuarioPessoaId();
        $entrada = $this->unitofwork->Get(new MensagemPessoa(), "PessoaId = '".$usuarioid."' AND Lida = '0' AND
        Apagada = '0'")->ToList();
        $lixeira = $this->unitofwork->Get(new MensagemPessoa(), "PessoaId = '".$usuarioid."' AND Lida = '0' AND
        Apagada = '1'")->ToList();

        $retorno = new \stdClass();
        $retorno->Entrada = $entrada->Count();
        $retorno->Lixeira = $lixeira->Count();

        echo json_encode($retorno);
    }
}