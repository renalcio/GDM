<?
use Libs\Form;
?>


<div id="row">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Cadastro de Aplicações
            </h3>

        </div>
        <div class="box-body">
            <pre>
            <? print_r($Model->Pessoa)?>
                </pre>
            <form>
                <?Form::Hidden("AplicacaoId", @$Model->AplicacaoId);?>
                <div class="form-group">
                    <label>
                        CPF / CNPJ:
                    </label>
                    <?Form::Text("Documento", @$Model->Documento, Array("class" => "form-control"));?>
                </div>
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

            </form>
        </div>
        <div class="box-footer">
            <div class="row">
                    <a href="apps/cadastro" class="btn btn-primary btn-sm" style="float: right; margin-right: 15px;" ><i class="fa
                    fa-plus"></i> Salvar</a>
            </div>
        </div>
    </div>
</div>

