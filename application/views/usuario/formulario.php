<?
use Libs\Form;
?>
<?
Form::Hidden("UsuarioId", @$Model->UsuarioId);
Form::Hidden("PessoaId", @$Model->PessoaId);
Form::Hidden("Avatar", @$Model->Avatar, Array("class" => "hiddenImgArea"));
Form::Hidden("Ativo", @$Model->Ativo);
?>
<div id="row">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados do Usuário
            </h3>

        </div>

        <div class="box-body">
            <? if(APP_ID == ROOTAPP){
                ?>
                <div class="form-group">
                    <label>
                        Aplicação:
                    </label>
                    <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control AplicacaoSelect", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
                </div>
            <?
            }else{
                $Model->AplicacaoId = APP_ID;
                Form::Hidden("AplicacaoId", APP_ID);
            }?>

            <script>
                $(function(){
                        $("select.AplicacaoSelect").change(function(){
                            var appId = $(this).val();
                            console.log(appId);
                            $.get("<?=URL;?>handler/perfil/Select2Tag/" + appId, function(data){
                                console.log(data);
                                //$("input.PerfilSelect").select2('destroy');
                                $("input.PerfilSelect").select2({
                                    multiple: true,
                                    "data": data
                                });
                                if(appId != '<?=$Model->AplicacaoId?>') {
                                    $("input.PerfilSelect").val("").change();
                                }else{
                                    $("input.PerfilSelect").val("<?=$Model->ListPerfil?>").change();
                                }
                            });
                        });
                });
            </script>

            <div class="form-group">
                <label>
                    Perfil:
                </label>
                <? Form::Select2Tag("ListPerfil", @$Model->ListPerfil, "", Array(
                    "class" => "form-control PerfilSelect",
                    "DataUrl" => URL."handler/perfil/Select2Tag/".@$Model->AplicacaoId))?>
            </div>

            <div class="form-group">
                <label>
                    Login:
                </label>
                <?Form::Text("Login", @$Model->Login, Array("class" => "form-control"));?>
            </div>

            <? if(empty($Model->UsuarioId)) { ?>
                <div class="form-group">
                    <label>
                        Senha:
                    </label>
                    <?Form::Password("Senha", @$Model->Senha, Array("class" => "form-control"));?>
                </div>
            <? } ?>
        </div>
    </div>
</div>
<? if(!empty($Model->UsuarioId)) { ?>
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
<? } ?>

