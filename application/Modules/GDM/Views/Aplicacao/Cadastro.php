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
        <h3>Dados do <b>Cliente</b></h3>
        <?  Helper::LoadModelView(@$Model->Pessoa, "formulario", "pessoa");?>
    </div>

    <h3>Dados da <b>Aplicação</b></h3>
    <div id="row">
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">
                    <b>Caracteristicas</b> da Aplicação
                </h3>

            </div>
            <div class="panel-content">

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