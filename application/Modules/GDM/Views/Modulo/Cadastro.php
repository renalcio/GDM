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

            <!--<div class="form-group" for="Handler">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Handler");?>
                </label><br>
                <input type="checkbox" ref="<?=@$Model->Handler;?>" name="Handler" class="switch" <? if($Model->Handler == 1) echo "checked";?> data-off-color="default" data-on-text="Sim" data-off-text="Não" />
            </div>-->

            <?
            //var_dump($Model->ListActionModulo);
            if(!empty($Model->ListAction)){
                $Model->ListAction->For_Each(function($item) use ($Model){
                   var_dump($item);
                    $teste = $Model->ListActionModulo->Where(function($x) use ($item){
                        return ($x->ActionId == $item->ActionId);
                    });
                    if($teste->Count() > 0)
                        var_dump($teste);
                });
            }
            ?>

        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>