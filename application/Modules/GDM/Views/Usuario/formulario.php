<?
use Libs\Form;
?>
<?
Form::Hidden("UsuarioId", @$Model->UsuarioId);
Form::Hidden("PessoaId", @$Model->PessoaId);
Form::Hidden("Avatar", @$Model->Avatar, Array("class" => "hiddenImgArea"));
?>
<div id="row">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados do Usuário
            </h3>

        </div>

        <div class="box-body">
            <? if(APP_ID != ROOTAPP){ ?>
            <div class="form-group" for="ListPerfil">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ListPerfil");?>
                </label>
                <? Form::Select2Tag("ListPerfil", @$Model->ListPerfil, "", Array(
                    "class" => "form-control PerfilSelect",
                    "DataUrl" => URL."handler/perfil/Select2Tag/".APP_ID))?>
            </div>
            <?
            }else{
                Form::Hidden("ListPerfil", @$Model->ListPerfil);
            }
            ?>


            <div class="form-group" for="Login">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Login");?>
                </label>
                <?Form::Text("Login", @$Model->Login, Array("class" => "form-control"));?>
            </div>

            <? if(empty($Model->UsuarioId)) { ?>
                <div class="form-group" for="Senha">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Senha");?>
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
                    <div class="form-group col-lg-6" for="NovaSenha">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "NovaSenha");?>
                        </label>
                        <?Form::Password("NovaSenha", @$Model->NovaSenha,
                            Array("class" => "form-control"));?>
                    </div>

                    <div class="form-group col-lg-6" for="ConfirmarNovaSenha">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "ConfirmarNovaSenha");?>
                        </label>
                        <?Form::Password("ConfirmarNovaSenha", @$Model->ConfirmarNovaSenha, Array("class" => "form-control"));?>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
<? } ?>

