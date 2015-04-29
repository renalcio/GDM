<?
use Libs\Form;
$Model = new \DAL\ClassHub\Aluno();
?>
<script>
    $(function(){
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        $("#EscolaId").change(function(){
            var EscolaId = $(this).val();
            $.get("<?=URL;?>handler/turma/Select2/"+EscolaId, function(data){
                $("select.TurmaSelec2").html(data);
                $("select.TurmaSelec2").val("").change();
            });
        });
    });
</script>
<h3 class="page-header">Pre Cadastro de Aluno</h3>
<form method="post">
    <?
    Form::ValidationSummary();
    ?>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados Básicos
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="Pessoa_Nome">
                <label>
                    Nome
                </label>
                <? Form::Text("Pessoa_Nome", @$Model->Pessoa->Nome, Array("class" => "form-control"))?>
            </div>
            <div class="form-group" for="Pessoa_Email">
                <label>
                    Email
                </label>
                <? Form::Text("Pessoa_Email", @$Model->Pessoa->Email, Array("class" => "form-control"))?>
            </div>
                <div class="form-group">
                    <label>
                        Escola
                    </label>
                    <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaSelect2", "DataUrl" => URL."handler/escola/Select2" ));?>
                </div>
                <div class="form-group" for="TurmaId">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "TurmaId");?>
                    </label>
                    <? Form::Select2("TurmaId", @$Model->TurmaId, "", Array("class" => "form-control TurmaSelec2", "DataUrl" => URL."handler/turma/Select2" ));?>
                </div>

            <div class="form-group" for="ChaveRegistro">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ChaveRegistro");?>
                </label>
                <? Form::Text("ChaveRegistro", @$Model->ChaveRegistro, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Representante">
                <? Form::Checkbox("Representante", @$Model->Representante,[
                    "class" => "minimal",
                    ((!empty($Model->Representante)) ? "checked" : "") => ((!empty($Model->Representante)) ? "checked" : "")
                ]); ?>
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Representante");?>
                </label>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>