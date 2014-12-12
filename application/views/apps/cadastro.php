<?
use Libs\Form;
use Libs\Session;
?>
<script>
    $(function(){
        SubFormulario("#formPessoa", "Pessoa");

        $("#Pessoa_PessoaFisica_CPF, #Pessoa_PessoaJuridica_CNPJ").blur(function(){
            console.log("teste");
            BuscaPessoa($(this).val(), "Pessoa");
        });
    });

</script>
<h3 class="page-header">Cadastro de Aplicação</h3>
<form method="post">
    <div id="formPessoa">
        <?  \Libs\Helper::LoadModelView(@$Model->Pessoa, "formulario", "pessoas");?>
    </div>
    <div id="row">
        <h4 class="page-header">Aplicação</h4>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Dados da Aplicação
                </h3>

            </div>
            <div class="box-body">
            <pre>
            <? print_r($Model)?>
                </pre>

                <?Form::Hidden("AplicacaoId", @$Model->AplicacaoId);?>

                <div class="form-group">
                    <label>
                        Título:
                    </label>
                    <?Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"));?>
                </div>
                <div class="form-group">
                    <label>
                        Descricao:
                    </label>
                    <?Form::Wysiwyg("Descricao", @$Model->Descricao);?>
                </div>

            </div>
            <div class="box-footer">
                <div class="row">
                    <a href="apps/cadastro" class="btn btn-primary btn-sm" style="float: right; margin-right: 15px;" ><i class="fa
                    fa-plus"></i> Salvar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=URL?>pessoas/" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>