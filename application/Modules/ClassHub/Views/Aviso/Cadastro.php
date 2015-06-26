<?
use Libs\Form;
//$Model = new \Model\ClassHub\Aviso();
//var_dump($Model);
?>

<script>
    $(function(){

        $("#EscolaId").change(function(){
            var id = $(this).val();
            $.get("<?=URL;?>handler/curso/Select2/"+id, function(data){
                $("select.CursoIdSelect").html(data);
                $("select.CursoIdSelect").val("<?=@$Model->CursoId;?>").change();
            });
        });
        $("#CursoId").change(function(){
            var id = $(this).val();

            $.get("<?=URL;?>handler/turma/Select2/"+id, function(data){
                $("select.TurmaIdSelect").html(data);
                $("select.TurmaIdSelect").val("<?=@$Model->TurmaId;?>").change();
            });
        });

        $(".switch").on('switchChange.bootstrapSwitch', function(event, state) {
            var ref = $(this).attr("ref"); // true | false (state)
        });
    });

    function PreView(){
        var titulo = $("#Titulo").val();
        var descricao = $("#Descricao").val();
        var tipo = $("#Tipo").val();
        $("#AlertPreview").attr("class", "alert alert-dismissable alert-"+tipo).html('<h4>'+titulo+'</h4>').append(descricao).show();
    }
</script>

<form method="post" enctype="multipart/form-data">
    <?
    Form::ValidationSummary();
    Form::Hidden("AvisoId", @$Model->AvisoId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>

    <div class="panel panel-primary">
        <div class="panel-header">
            <h3>
                Dados do Aviso
            </h3>
        </div>
        <div class="panel-content">
            <div class="row">
                <div for="EscolaId" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                    </label>
                    <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
                </div>
                <div for="CursoId" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "CursoId");?>
                    </label>
                    <? Form::Select2("CursoId", @$Model->CursoId, "", Array("class" => "form-control CursoIdSelect", "DataUrl" => URL."handler/curso/Select2" ))?>
                </div>

                <div for="TurmaId" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "TurmaId");?>
                    </label>
                    <? Form::Select2("TurmaId", @$Model->TurmaId, "", Array("class" => "form-control TurmaIdSelect",
                        "DataUrl" => URL."handler/turma/Select2" ))?>
                </div>

                <div class="col-md-3" for="txDataDe">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "txDataDe");?>
                    </label>
                    <? Form::DatePicker("txDataDe", @$Model->txDataDe, ["class" => "form-control"])?>
                </div>

                <div class="col-md-3" for="txDataAte">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "txDataAte");?>
                    </label>
                    <? Form::DatePicker("txDataAte", @$Model->txDataAte, ["class" => "form-control"])?>
                </div>

                <div class="col-md-2" for="Alerta">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Alerta");?>
                    </label><br>
                    <? Form::Checkbox("Alerta", "1", @$Model->Alerta, [
                            "class" => "switch ".((@$Model->Alerta == 1) ? "checked" : ""),
                            "data-size" => "medium",
                            "data-off-color" => "danger",
                            "data-on-text" => "<i class='fa fa-check'></i>",
                            "data-off-text" => "<i class='fa fa-times'></i>"]
                    );?>
                </div>

                <div class="col-md-4" for="Tipo">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Tipo");?>
                    </label>
                    <? Form::Select2("Tipo", @$Model->Tipo, [
                        "info" => "Informação",
                        "warning" => "Aviso",
                        "danger" => "Alerta",
                        "success" => "Sucesso"
                    ], ["class" => "form-control"])?>
                </div>


                <div class="col-md-12" for="Titulo">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                    </label>
                    <? Form::Text("Titulo", @$Model->Titulo, ["class" => "form-control"])?>
                </div>

                <div class="col-md-12" for="Descricao">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Descricao");?>
                    </label>
                    <? Form::TextArea("Descricao", @$Model->Descricao, ["class" => "form-control"])?>
                </div>
            </div>
        </div>

    </div>

    <div class="alert" style="display: none" id="AlertPreview"></div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger " href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar</button>
            <button type="button" onclick="PreView();" class="btn btn-default pull-right"
                    style="margin-right: 10px">Pré-visualizar</button>
        </div>
    </div>
</form>