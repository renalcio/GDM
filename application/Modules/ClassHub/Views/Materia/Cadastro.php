<?
use Libs\Form;
//$Model = new \DAL\ClassHub\Escola();
?>
<h3 class="page-header">Cadastro de Curso</h3>

<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("ArtistaId", @$Model->CursoId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Escola
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>

            <div for="EscolaId">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                </label>
                <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>