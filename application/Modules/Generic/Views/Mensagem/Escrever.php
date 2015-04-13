<?
use Libs\Form;
$Model = new \DAL\Mensagem();

?>
<form method="post">
    <div class="row">
        <div class="col-md-3">
            <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Voltar a Entrada</a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Pastas</h3>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Entrada <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> Saída</a></li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Lixeira</a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Escrever Nova Mensagem</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <? Form::Select2Tag("ListPerfil", @$Model->ListPerfil, "", [
                            "class" => "form-control PerfilSelect",
                            "placeholder" => "Para:",
                            "DataUrl" => URL."handler/pessoa/Select2Tag/"])?>
                    </div>
                    <div class="form-group">
                        <? Form::Text("Assunto", @$Model->Assunto, ["class" => "form-control", "placeholder" => "Assunto:"])?>
                    </div>
                    <div class="form-group">
                        <?Form::Wysiwyg("Conteudo", @$Model->Conteudo);?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                    </div>
                    <button class="btn btn-default"><i class="fa fa-times"></i> Cancelar</button>
                </div><!-- /.box-footer -->
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</form>