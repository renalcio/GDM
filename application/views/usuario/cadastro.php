<?
use Libs\Helper;
?>
<?  Helper::LoadModelView($Model, "avatar", "usuario");?>
<br>
<script>
    $(function(){
        SubFormulario("#formPessoa", "Pessoa");
        $("#Pessoa_PessoaFisica_CPF, #Pessoa_PessoaJuridica_CNPJ").blur(function(){
            BuscaPessoa($(this).val(), "Pessoa");
        });
    });
</script>
<form method="post">

    <?
    \Libs\ModelState::addError("Erro teste");
    \Libs\Form::ValidationSummary();
    ?>

    <?  Helper::LoadModelView($Model, "formulario", "usuario");?>
    <div id="formPessoa">
        <h3 class="page-header">Dados Pessoais</h3>
        <?  Helper::LoadModelView(@$Model->Pessoa, "formulario", "pessoa");?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>usuario/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>

