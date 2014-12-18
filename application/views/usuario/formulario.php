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
                <div class="form-group">
                    <label>
                        Login:
                    </label>
                    <?Form::Text("Login", @$Model->Login, Array("class" => "form-control"));?>
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


            </div>
        </div>
    </div>

