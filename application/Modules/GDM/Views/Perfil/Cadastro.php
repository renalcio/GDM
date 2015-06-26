<?
use Libs\Form;
use Libs\SessionHelper;
?>
<form method="post">
    <div id="row">
        <div class="panel panel-primary">
            <div class="panel-header">
                <h3>
                    Dados do Perfil
                </h3>

            </div>
            <div class="panel-content">

                <?
                Form::Hidden("PerfilId", @$Model->PerfilId);

                if(APPID == ROOTAPP){
                    ?>
                    <div class="form-group">
                        <label>
                            Aplicação:
                        </label>
                        <? Form::Select2("AplicacaoId", @$Model->AplicacaoId, "", Array("class" => "form-control", "DataUrl" => URL."handler/aplicacao/Select2" ))?>
                    </div>
                <?
                }else
                    Form::Hidden("AplicacaoId", @$Model->AplicacaoId);

                Form::Hidden("Ativo", @$Model->Ativo);
                ?>

                <div class="form-group">
                    <label>
                        Título:
                    </label>
                    <?Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"));?>
                </div>

                <div class="form-group">
                    <label>
                        Nivel:
                    </label>
                    <?Form::Number("Nivel", @$Model->Nivel, Array("class" => "form-control"));?>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger" href="<?=\Libs\Helper::getUrl("index")?>">Cancelar</a>   <button type="submit" class="btn btn-primary pull-right">Salvar</button></div>
    </div>
</form>