<?
use Libs\Form;
$Model = new \DAL\Site();
?>
<h3 class="page-header">Cadastro de Site</h3>
<form method="post">
    <?Form::Hidden("NichoId", @$Model->SiteId);?>

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                  Aplicação e Acesso
                </h3>
            </div>
            <div class="box-body">
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
                    <? Form::Number("NivelAcesso", @$Model->NivelAcesso, "", Array("class" => "form-control"))?>
                </div>
            </div>
            
        </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Informações do Site
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>
                    Título:
                </label>
                <?Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"));?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>