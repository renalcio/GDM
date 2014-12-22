<?
use Libs\Form;
?>
    <?Form::Hidden("UsuarioId", @$Model->UsuarioId);?>
    <div id="row">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Dados do Usuário
                </h3>

            </div>

            <div class="box-body">
                <? if(APP_ID == 1){
                    ?>
                    <div class="form-group">
                        <label>
                            Aplicação:
                        </label>
                        <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
                    </div>
                <?
                }else{
                    Form::Hidden("AplicacaoId", APP_ID);
                }?>
                <div class="form-group">
                    <label>
                        Login:
                    </label>
                    <?Form::Text("Login", @$Model->Login, Array("class" => "form-control"));?>
                </div>



            </div>
        </div>
    </div>
<div id="row">
    <div class="box box-solid box-primary collapsed-box">
        <div class="box-header">
            <h3 class="box-title">Alterar Senha</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa
                fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body" style="display:none;">
            <div class="callout callout-warning">
                <h4>Atenção!</h4>
                <p>Altere apenas se deseja alterar sua senha atual.</p>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    <label>
                        Nova Senha:
                    </label>
                    <?Form::Password("NovaSenha", @$Model->NovaSenha,
                        Array("class" => "form-control"));?>
                </div>

                <div class="form-group col-lg-6">
                    <label>
                        Confirmar Nova Senha:
                    </label>
                    <?Form::Password("ConfirmarNovaSenha", @$Model->ConfirmarNovaSenha, Array("class" => "form-control"));?>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
</div>

