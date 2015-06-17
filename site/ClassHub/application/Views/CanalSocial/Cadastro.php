<?
use Libs\Form;
//$Model = new \Model\ClassHub\Avaliacao();
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

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>

<form method="post" enctype="multipart/form-data">
    <?
    Form::ValidationSummary();
    Form::Hidden("AvaliacaoId", @$Model->AvaliacaoId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Avaliação
            </h3>
        </div>
        <div class="box-body">
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

                <div for="Tipo" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Tipo");?>
                    </label>
                    <? Form::Select2("Tipo", @$Model->Tipo, ["Página do Facebook" => "Página do Facebook",
                            "Grupo do Facebook" => "Grupo do Facebook", "Email da Classe" => "Email da Classe",
                            "GitHub" => "GitHub"],
                        ["class" => "form-control"])?>
                </div>

                <div class="col-md-8" for="Url">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Url");?>
                    </label>
                    <? Form::Text("Url", @$Model->Url, ["class" => "form-control"])?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <hr></div>
                <div class="col-md-6" for="Login">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Login");?> <i>(Opcional)</i>
                    </label>
                    <? Form::Text("Login", @$Model->Login, ["class" => "form-control"])?>
                </div>

                <div class="col-md-6" for="Senha">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Senha");?> <i>(Opcional)</i>
                    </label>
                    <? Form::Text("Senha", @$Model->Senha, ["class" => "form-control"])?>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>