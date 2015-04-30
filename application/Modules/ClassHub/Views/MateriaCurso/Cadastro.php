<?
use Libs\Form;
$Model = new \DAL\ClassHub\MateriaCurso();
?>
<script>
    $(function(){
        $("#EscolaId").change(function(){
            var EscolaId = $(this).val();
            $("#CursoIdGroup").fadeOut();
            $.get("<?=URL;?>handler/curso/Select2/"+EscolaId, function(data){
                $("select.CursoSelect2").html(data);
                $("select.CursoSelect2").val("").change();
                $("#CursoIdGroup").fadeIn();
            });
        });
    });
</script>
<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("MateriaId", @$Model->MateriaId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Adicionar Curso
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" for="EscolaId">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                        </label>
                        <? Form::Select2("EscolaId", @$Model->EscolaId,"", ["class" => "form-control", "DataUrl" => URL."handler/escola/select2"]);?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="CursoIdGroup" class="form-group" style="display:none;" for="CursoId">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "CursoId");?>
                        </label>
                        <? Form::Select2("CursoId", @$Model->CursoId,"", ["class" => "form-control CursoSelect2", "DataUrl" => URL."handler/curso/select2"]);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-lg-12">   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
            </div>
        </div>

    </div>



</form>