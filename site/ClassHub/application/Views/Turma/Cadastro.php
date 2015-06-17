<?
use Libs\Form;
//$Model = new \Model\ClassHub\Escola();
?>
<h3 class="page-header">Cadastro de Turma</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("ArtistaId", @$Model->TurmaId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Turma
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" for="CursoId">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "CursoId");?>
                        </label>
                        <? Form::Select2("CursoId", @$Model->CursoId, "", Array("class" => "form-control CursoIdSelect", "DataUrl" => URL."handler/curso/Select2" ))?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" for="Turno">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Turno");?>
                        </label>
                        <? Form::DropDown("Turno", @$Model->Turno, [
                            "Manhã"=>"Manhã",
                            "Tarde"=>"Tarde",
                            "Noite"=>"Noite"
                        ], ["class" => "form-control"])?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" for="Semestre">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Semestre");?>
                        </label>
                        <? Form::DropDown("Semestre", @$Model->Semestre,[
                            "1"=>"1",
                            "2"=>"2"
                        ], ["class" => "form-control"])?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" for="Ano">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Ano");?>
                        </label>
                        <? Form::Number("Ano", @$Model->Ano, Array("class" => "form-control"))?>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>