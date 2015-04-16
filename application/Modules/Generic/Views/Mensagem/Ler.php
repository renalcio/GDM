<?
//$Model = new \DAL\Mensagem();
$enviada = false;
$UsuarioId = \Libs\UsuarioHelper::GetUsuarioPessoaId();
//var_dump($Model->PessoaId);
//var_dump($UsuarioId);
if($Model->Mensagem->PessoaId == $UsuarioId)
    $enviada = true;
?><div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ler Mensagem</h3>
        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Próxima"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Anterior"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3><?=@$Model->Mensagem->Assunto;?></h3>
            <h5>De: <?=@$Model->Mensagem->Pessoa->Nome;?> <span class="mailbox-read-time pull-right"><?=date("d/m/Y - H:i:s", @$Model->Mensagem->DataEnvio);?></span></h5>
            <h5>Para: <?=@$Model->Pessoa->Nome;?></h5>
        </div><!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
                <? if(!$enviada) { ?>
                <a href="<?=\Libs\Helper::getUrl("deletar", "", @$Model->MensagemPessoaId);?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Apagar"><i class="fa fa-trash-o"></i></a>
                <? } ?>
                <a href="<?=\Libs\Helper::getUrl("responder", "", @$Model->MensagemPessoaId);?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Responder"><i class="fa fa-reply"></i></a>
                <a href="<?=\Libs\Helper::getUrl("responder", "", [@$Model->MensagemPessoaId, 1]);?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Encaminhar"><i class="fa
                        fa-share"></i></a>
            </div><!-- /.btn-group -->
            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></button>
        </div><!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            <?=@$Model->Mensagem->Conteudo;?>
        </div><!-- /.mailbox-read-message -->
    </div><!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">
            <button class="btn btn-default"><i class="fa fa-reply"></i> Responder</button>
            <button class="btn btn-default"><i class="fa fa-share"></i> Encaminhar</button>
        </div>
        <? if(!$enviada) { ?>
        <a href="<?=\Libs\Helper::getUrl("deletar", "", @$Model->MensagemPessoaId);?>" class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</a>
        <? } ?>
        <button class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
    </div><!-- /.box-footer -->
</div><!-- /. box -->
