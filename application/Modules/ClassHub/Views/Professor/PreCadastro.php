<?
use Libs\Form;
//$Model = new \DAL\ClassHub\Aluno();
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
<h3 class="page-header">Pre Cadastro de Professor</h3>
<form method="post">
    <?
    Form::ValidationSummary();
    Form::Hidden("PessoaId", @$Model->PessoaId);
    Form::Hidden("ProfessorId", @$Model->ProfessorId);
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
                <? Form::Text("Pessoa_Email", @$Model->Pessoa->Email, ["class" => "form-control"])?>
            </div>
                <div class="form-group">
                    <label>
                        Escola
                    </label>
                    <? Form::Select2("EscolaId", @$Model->EscolaId, "", ["class" => "form-control EscolaSelect2", "DataUrl" => URL."handler/escola/Select2" ]);?>
                </div>

            <div class="form-group" for="ChaveRegistro">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ChaveRegistro");?>
                </label>
                <? Form::Text("ChaveRegistro", @$Model->ChaveRegistro, Array("class" => "form-control"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>