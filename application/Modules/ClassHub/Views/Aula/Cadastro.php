<?
use Libs\Form;
//$Model = new \DAL\ClassHub\Aula();
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

            $.get("<?=URL;?>handler/professor/Select2/"+id, function(data){
                $("select.ProfessorIdSelect").html(data);
                $("select.ProfessorIdSelect").val("<?=@$Model->ProfessorId;?>").change();
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
    });
</script>

<h3 class="page-header">Cadastro de Aula</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("AulaId", @$Model->AulaId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Aula
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" for="Data">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                        </label>
                        <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" for="HoraDe">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "HoraDe");?>
                        </label>
                        <? Form::TimePicker("HoraDe", @$Model->HoraDe, Array("class" => "form-control"))?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" for="HoraAte">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "HoraAte");?>
                        </label>
                        <? Form::TimePicker("HoraAte", @$Model->HoraAte, Array("class" => "form-control"))?>
                    </div>
                </div>

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
                <div for="ProfessorId" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "ProfessorId");?>
                    </label>
                    <? Form::Select2("ProfessorId", @$Model->ProfessorId, "", Array("class" => "form-control
                    ProfessorIdSelect", "DataUrl" => URL."handler/professor/Select2" ))?>
                </div>

                <div class="col-md-1" for="Sala">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Sala");?>
                    </label>
                    <? Form::Text("Sala", @$Model->Sala, Array("class" => "form-control"))?>
                </div>

                <div class="col-md-11" for="Titulo">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                    </label>
                    <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
                </div>

                <div class="col-md-12" for="Conteudo">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Conteudo");?>
                    </label>
                    <? Form::Wysiwyg("Conteudo", @$Model->Conteudo)?>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>