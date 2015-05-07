<?
use Libs\Form;
$Model = new \DAL\ClassHub\Aula();
?>
<h3 class="page-header">Cadastro de Aula</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("AulaId", @$Model->AulaId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Aula
            </h3>
        </div>
        <div class="box-body">
            <div for="EscolaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                </label>
                <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
            <div for="MateriaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "MateriaId");?>
                </label>
                <? Form::Select2("MateriaId", @$Model->MateriaId, "", Array("class" => "form-control MateriaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>

            <div for="TurmaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "TurmaId");?>
                </label>
                <? Form::Select2("TurmaId", @$Model->TurmaId, "", Array("class" => "form-control TurmaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
            <div for="ProfessorId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ProfessorId");?>
                </label>
                <? Form::Select2("ProfessorId", @$Model->ProfessorId, "", Array("class" => "form-control ProfessorIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" for="Data">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                        </label>
                        <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" for="HoraDe">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                        </label>
                        <? Form::TimePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                    </div>
                </div>
            </div>
            <div class="form-group" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>