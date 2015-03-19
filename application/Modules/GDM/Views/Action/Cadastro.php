<?
use Libs\Form;
$Model = new \DAL\Action();
?>
<h3 class="page-header">Cadastro de Actions</h3>
<form method="post">
    <?Form::Hidden("ModuloId", @$Model->ActionId);?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Informações da Action
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group" for="ModuloId">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ModuloId");?>
                </label>
                <? Form::Select2("ModuloId", @$Model->ModuloId, "", Array("class" => "form-control AplicacaoSelect",
                    "DataUrl" => URL."handler/Modulo/Select2" ))?>
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

            <div class="form-group" for="Publico">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Publico");?>
                </label><br>
                <input type="checkbox" ref="<?=@$Model->Publico;?>" name="Publico" class="switch" <? if($Model->Publico == 1) echo "checked";?> data-off-color="default" data-on-text="Sim" data-off-text="Não" />
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>