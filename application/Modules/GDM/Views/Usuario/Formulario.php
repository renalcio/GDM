<?
use Libs\Form;
?>
<?
Form::Hidden("UsuarioId", @$Model->UsuarioId);
Form::Hidden("PessoaId", @$Model->PessoaId);
Form::Hidden("Avatar", @$Model->Avatar, Array("class" => "hiddenImgArea"));
?>
<div id="row">
    <div class="panel panel-primary">
        <div class="panel-header">
            <h3 class="panel-title">
                Dados do Usuário
            </h3>

        </div>

        <div class="panel-content">
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
        <div class="panel panel-solid panel-primary collapsed-panel">
            <div class="panel-header">
                <h3 class="panel-title">Alterar Senha</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div class="panel-content" style="display:none;">
                <div class="panel bg-yellow">
                    <div class="panel-content" style="display:none;">
                        <p>Altere apenas se deseja alterar sua senha atual.</p>
                    </div>
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
            </div><!-- /.panel-body -->
        </div>
    </div>
<? } ?>

