<?
//$Model = new \DAL\Mensagem();
?>
<form method="post" action="<?=\Libs\Helper::getUrl("escrever");?>">
<div class="row">
    <div class="col-md-3">
        <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Escrever</a>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Pastas</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Entrada <span class="label label-primary pull-right">12</span></a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> Saida</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-trash-o"></i> Lixeira</a></li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
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
                </div><!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Apagar"><i class="fa fa-trash-o"></i></button>
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
                <button class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</button>
                <button class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
            </div><!-- /.box-footer -->
        </div><!-- /. box -->
    </div><!-- /.col -->
</div><!-- /.row -->
    </form>