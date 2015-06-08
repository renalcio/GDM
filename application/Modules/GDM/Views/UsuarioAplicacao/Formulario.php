<?
use Libs\Form;
?>
<?Form::Hidden("UsuarioAplicacaoId", @$Model->UsuarioAplicacaoId);?>
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary">
        <div class="box-body">
            <script>
                function GetPessoa(){
                    var doc = $("#Documento").val();
                    $.get("<?=URL;?>handler/usuario/GetByDoc/" + doc, function(data){
                        if(data != "" && data != null) {
                            $("#UsuarioId").val(data.UsuarioId);
                            $("#usrAvatar").attr("src", data.Avatar);
                            $("#usrInfo h4").html(data.Pessoa.Nome);
                            $("#usrInfo i").html(data.Login);
                        }else{
                            $("#UsuarioId").val(0);
                            $("#usrAvatar").attr("src", "<? $nusr = new \Model\Usuario(); echo $nusr->Avatar; ?>");
                            $("#usrInfo h4").html("Nenhum usuário encontrado");
                            $("#usrInfo i").html("");
                        }
                    });
                }
                $(function(){
                    GetPessoa();
                    $("#Documento").on("blur change keyup", function(){
                        GetPessoa();
                    });
                });
            </script>
            <?Form::Hidden("UsuarioId", @$Model->UsuarioId);?>
            <table cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px;" align="center">
                <tr>
                    <td width="100px" style="padding-right:10px;" align="center">
                        <img src="<?=@$Model->Usuario->Avatar;?>" id="usrAvatar" width="90px"
                             class="img-circle" />
                    </td>
                </tr>
                    <tr>
                    <td valign="top" align="center" id="usrInfo">
                        <h4><?=@$Model->Usuario->Pessoa->Nome; ?></h4>
                        <i><?=@$Model->Usuario->Login; ?></i>
                    </td>
                </tr>
            </table>

            <div class="form-group" for="Documento">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Documento");?>
                </label>
                <?Form::Text("Documento", @$Model->Documento, Array("class" => "form-control"));?>
            </div>



        </div>
    </div>
    </div>

    <div class="col-lg-6">
        <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
               Vínculo
            </h3>

        </div>

        <div class="box-body">


            <? if(APP_ID == ROOTAPP){
                ?>
                <div class="form-group" for="AplicacaoId">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "AplicacaoId");?>
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

            <div class="form-group" for="ListPerfil">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ListPerfil");?>
                </label>
                <? Form::Select2Tag("ListPerfil", @$Model->ListPerfil, "", Array(
                    "class" => "form-control PerfilSelect",
                    "DataUrl" => URL."handler/perfil/Select2Tag/".@$Model->AplicacaoId))?>
            </div>

        </div>
    </div>
    </div>
</div>

