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
    \Libs\Form::ValidationSummary();
    ?>

    <?  Helper::LoadModelView($Model, "formulario", "usuario");?>
    <div id="formPessoa">
        <?  Helper::LoadModelView(@$Model->Pessoa, "formulario", "pessoa");?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger" href="<?=URL?>usuario/" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>

