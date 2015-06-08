<?
use Libs\Form;
//$Model = new \Model\Mensagem();

?>
<form method="post">
    <? Form::Hidden("Encaminhamento", @$Model->Encaminhamento)?>
    <? Form::Hidden("RespostaId", @$Model->RespostaId)?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Escrever Nova Mensagem</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <? Form::Select2Tag("Para", @$Model->Para, "", [
                            "class" => "form-control PerfilSelect",
                            "placeholder" => "Para: ",
                            "DataUrl" => URL."handler/pessoa/Select2Tag/"])?>
                    </div>

                    <div class="form-group">
                        <? Form::Select2Tag("Copia", @$Model->Copia, "", [
                            "class" => "form-control PerfilSelect",
                            "placeholder" => "Copias: ",
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
                    <a href="<?=\Libs\Helper::getUrl("index");?>" class="btn btn-default"><i class="fa fa-times"></i> Cancelar</a>
                </div><!-- /.box-footer -->
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</form>