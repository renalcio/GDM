<?
use Libs\Form;
//$Model = new \Model\Modulo();
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

        </div>
    </div>

    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">
                Actions
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <?
                    //var_dump($Model->ListActionModulo);
                    if(!empty($Model->ListAction)){
                        $Model->ListAction->For_Each(function($item, $i) use ($Model){

                            ?>
                            <div class="col-md-6 ">
                                <div class="well well-sm no-margin" style="margin-bottom: 3px;">

                                <?
                                $check = $Model->ListActionModulo->Where(function($x) use ($item){
                                    return ($x->ActionId == $item->ActionId);
                                });
                                if($check->Count() > 0) { ?>
                                    <input type="checkbox" checked="checked" value="1" name="Actions[<?=$i?>][Check]"/>
                                    <input type="hidden" value="<?=$check->First()->ActionModuloId;?>" name="Actions[<?=$i?>][ActionModuloId]"/>
                                <?
                                }else{
                                    ?>
                                    <input type="checkbox" value="1" name="Actions[<?=$i?>][Check]"/>
                                <? } ?>

                                <input type="hidden" value="<?=$item->ActionId;?>" name="Actions[<?=$i?>][ActionId]"/>

                                <span class="text"><?=$item->Titulo;?></span>

                                <? if($item->Handler > 0){ ?>
                                    <small class="label label-default">Handler</small>
                                <? } ?>

                                <div class="form-group pull-right">
                                    <input type="checkbox" name="Actions[<?=$i?>][Publico]" class="switch" <? if($check->Count() > 0 && $check->First()->Publico > 0) echo "checked";?> data-size="mini" data-off-color="default" data-on-text="Público" data-off-text="Privado" />
                                </div>

                            </div>
                            </div>
                        <?

                        });
                    }
                    ?>
            </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>