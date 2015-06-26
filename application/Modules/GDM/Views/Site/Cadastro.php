<?
use Libs\Form;
//$Model = new \Model\Site();
?>
<form method="post">
    <?Form::Hidden("SiteId", @$Model->SiteId);?>

    <div class="panel panel-primary">
        <div class="panel-header">
            <h3>
                <b>Aplicação</b> e Acesso
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-lg-6" for="AplicacaoId">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "AplicacaoId");?>
                    </label>
                    <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control AplicacaoSelect", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
                </div>

                <div class="form-group col-lg-6" for="NivelAcesso">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "NivelAcesso");?>
                    </label>
                    <? Form::Number("NivelAcesso", @$Model->NivelAcesso, Array("class" => "form-control", "min" => "0"))?>
                </div>
            </div>
        </div>

    </div>

    <div class="panel panel-primary">
        <div class="panel-header">
            <h3 class="panel-title">
                Informações do <b>Site</b>
            </h3>
        </div>
        <div class="panel-content">
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

            <div class="form-group" for="Url">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Url");?>
                </label>
                <? Form::Text("Url", @$Model->Url, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Metatags">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Metatags");?>
                </label>
                <? Form::Text("Metatags", @$Model->Metatags, Array("class" => "form-control", "data-role" => "tagsinput", "style" => "width: 100%"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>