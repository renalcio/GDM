<?
use Libs\Form;
//$Model = new \Model\ClassHub\Aluno();
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
                $("select.TurmaSelec2").val("<?=@$Model->TurmaId?>").change();
            });
        });
    });
</script>
<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("PessoaId", @$Model->PessoaId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>
    <div class="panel panel-primary">
        <div class="panel-header">
            <h3 class="panel-title">
                Dados Básicos
            </h3>
        </div>
        <div class="panel-content">
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
                <? Form::Text("Pessoa_Email", @$Model->Pessoa->Email, ["class" => "form-control"])?>
            </div>
                <div class="form-group">
                    <label>
                        Escola
                    </label>
                    <? Form::Select2("EscolaId", @$Model->EscolaId, "", ["class" => "form-control EscolaSelect2", "DataUrl" => URL."handler/escola/Select2" ]);?>
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
                <? Form::checkbox("Representante","1", @$Model->Representante,[
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
            <a type="submit" class="btn btn-danger" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>