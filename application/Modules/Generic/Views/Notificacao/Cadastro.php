<?
use Libs\Form;
//$Model = new \Model\Notificacao();

?>
<form method="post">
    <?Form::Hidden("NotificacaoId", @$Model->NotificacaoId);?>

    <div class="panel panel-primary">
        <div class="panel-header">
            <h3 class="panel-title">
                Informações da Notificação
            </h3>
        </div>
        <div class="panel-content">
            <? Form::Hidden("AplicacaoId", APPID);?>
            <div class="form-group" for="Conteudo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Conteudo");?>
                </label>
                <? Form::TextArea("Conteudo", @$Model->Conteudo, Array("class" => "form-control"))?>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Icone");?>
                    </label>
                    <div class="input-group" for="Icone">
                        <span class="input-group-addon" id="icon-span"><i class="fa <?=@$Model->Icone?>"></i></span>
                        <? Form::Text("Icone", @$Model->Icone, ["class" => "form-control"])?>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary m-0" data-toggle="modal" data-target="#iconeModal">Selecionar Icone</button>
                        </div><!-- /btn-group -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" for="Classe">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Classe");?>
                        </label>
                        <? Form::DropDown("Classe", @$Model->Classe,[
                            "" => "Padrão",
                            "text-aqua" => "Azul",
                            "text-yellow" => "Amarelo",
                            "text-green" => "Verde",
                            "text-red" => "Vermelho"
                        ], ["class" => "form-control"])?>
                    </div>
                </div>
            </div>


            <div class="form-group" for="Data">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                </label>
                <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>
<script>
    function GetCorIcone(){
        var cor = $("#Classe").val();
        var icone = $("#Icone").val();
        $("#icon-span i").attr("class", "fa "+icone+" "+cor);
    }
    $(function(){

        GetCorIcone();

        $("#Classe, #Icone").on("keypress keyup change",function(){
            GetCorIcone();
        });

        $("#BuscaIcone").on("keypress keyup change",function(){
            var termo = $(this).val();
            if(termo.length > 0) {
                $("#iconeModal .fontawesome-icon-list div").hide();
                $("#iconeModal .fontawesome-icon-list div:contains('" + termo + "')").show();
            }else{
                $("#iconeModal .fontawesome-icon-list div").show();
            }
        });

        $("#iconeModal .fontawesome-icon-list div").click(function(){
            var $ico = $(this).find("i");
            $ico.removeClass("fa");
            $ico.removeClass("fa-fw");
            var classe = $ico.attr("class");
            $ico.addClass("fa");
            $ico.addClass("fa-fw");
            $("#Icone").val(classe).change();
            $('#iconeModal').modal('hide');
        });
    });
</script>
<style>
    #iconeModal .fontawesome-icon-list div {
        padding: 10px;
    }
    #iconeModal .fontawesome-icon-list div:hover {
        background: #cecece;
    }
</style>
<!-- Modal icone -->
<div class="modal fade" id="iconeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Selecione um Icone</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <input type="text" id="BuscaIcone" class="pull-right form-control" placeholder="Pesquisar" />
                    </div>
                    <br>
                    <br>
                </div>
                <?  \Libs\Helper::LoadModelView($Model, "icones", "notificacao");?>
            </div>
        </div>
    </div>
</div>