<?
use Libs\Form;
//$Model = new \DAL\Modulo();
?>
<h3 class="page-header">Cadastro de Módulo</h3>
<form method="post">
    <?Form::Hidden("ModuloId", @$Model->ModuloId);?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Informações do Módulo
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="AplicacaoId">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "AplicacaoId");?>
                </label>
                <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control AplicacaoSelect", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
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
                <? Form::Wysiwyg("Descricao", @$Model->Descricao, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Handler">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Handler");?>
                </label><br>
                <input type="checkbox" ref="<?=@$Model->Handler;?>" name="Handler" class="switch" <? if($Model->Handler == 1) echo "checked";?> data-off-color="default" data-on-text="Sim" data-off-text="Não" />
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>