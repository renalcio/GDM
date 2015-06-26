<?
use Libs\Form;
use Libs\SessionHelper;
?>
<form method="post">
    <div id="row">
        <div class="panel panel-primary">
            <div class="panel-header">
                <h3 class="panel-title">
                  Dados do Nicho
                </h3>

            </div>
            <div class="panel-content">


                <?Form::Hidden("NichoId", @$Model->NichoId);?>

                <div class="form-group">
                    <label>
                        Título
                    </label>
                    <?Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"));?>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger" href="<?=\Libs\Helper::getUrl("index");?>" >Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>