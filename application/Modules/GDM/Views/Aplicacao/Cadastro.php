<?
use Libs\Form;
use Libs\Helper;
?>
<script>
    $(function(){
        SubFormulario("#formPessoa", "Pessoa");
        $("#Pessoa_PessoaFisica_CPF, #Pessoa_PessoaJuridica_CNPJ").blur(function(){
            BuscaPessoa($(this).val(), "Pessoa");
        });
    });
</script>
<form method="post">
    <div id="formPessoa">
        <h3 class="page-header">Dados do Cliente</h3>
        <?  Helper::LoadModelView(@$Model->Pessoa, "formulario", "pessoa");?>
    </div>
    <div id="row">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Cadastro de Aplicações
                </h3>

            </div>
            <div class="box-body">

                <?Form::Hidden("AplicacaoId", @$Model->AplicacaoId);?>
                <?Form::Hidden("PessoaId", @$Model->PessoaId);?>
                <div class="form-group">
                    <label>Nicho</label>
                <? Form::Select2("NichoId", @$Model->NichoId, "", Array("class" => "form-control", "DataUrl" => URL."handler/nicho/Select2" ))?>
                </div>
                <div class="form-group" for="Titulo">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                    </label>
                    <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
                </div>
                <div class="form-group" for="Descricao">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Descricao");?>
                    </label>
                    <?Form::Wysiwyg("Descricao", @$Model->Descricao);?>
                </div>
                <div class="form-group" for="Pasta">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Pasta");?>
                    </label>
                    <? Form::Text("Pasta", @$Model->Pasta, Array("class" => "form-control"))?>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=Helper::getUrl("index")?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>