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
            $.get("<?=URL;?>handler/materia/Select2/"+id, function(data){
                $("select.MateriaIdSelect").html(data);
                $("select.MateriaIdSelect").val("<?=@$Model->MateriaId;?>").change();
            });

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
Form::Hidden("Compartilhado", @$Model->Compartilhado);
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Dados da Avaliação
        </h3>
    </div>
    <div class="box-body">

            <div class="row">
            <div class="col-md-3">
                <div class="form-group" for="Data">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                    </label>
                    <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                </div>
            </div>
            <div class="col-md-9" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>
            </div>
        <div class="row">
            <div for="EscolaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                </label>
                <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
            <div for="CursoId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "CursoId");?>
                </label>
                <? Form::Select2("CursoId", @$Model->CursoId, "", Array("class" => "form-control CursoIdSelect", "DataUrl" => URL."handler/curso/Select2" ))?>
            </div>

            <div for="MateriaId" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "MateriaId");?>
                </label>
                <? Form::Select2("MateriaId", @$Model->MateriaId, "", Array("class" => "form-control
                    MateriaIdSelect", "DataUrl" => URL."handler/materia/Select2" ))?>
            </div>

            <div for="TurmaId" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "TurmaId");?>
                </label>
                <? Form::Select2("TurmaId", @$Model->TurmaId, "", Array("class" => "form-control TurmaIdSelect",
                    "DataUrl" => URL."handler/turma/Select2" ))?>
            </div>

            <div for="Trabalho" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Trabalho");?>
                </label>
                <div class="row">
                    <div class="col-sm-6">
                        <? Form::Radio("Trabalho", "0", @$Model->Trabalho, ["class" => "minimal"])?>
                         Prova
                    </div>
                    <div class="col-sm-6">
                        <? Form::Radio("Trabalho", "1", @$Model->Trabalho, ["class" => "minimal"])?> Trabalho
                    </div>
                </div>

            </div>

            <div class="col-md-12" for="Descricao">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Descricao");?>
                </label>
                <? Form::Wysiwyg("Descricao", @$Model->Descricao)?>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
</div>
</form>