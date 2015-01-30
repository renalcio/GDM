<?
use Libs\Form;
use Libs\SessionHelper;
?>
<h3 class="page-header">Cadastro de Nicho</h3>
<form method="post">
    <div id="row">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Dados do Nicho
                </h3>

            </div>
            <div class="box-body">

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
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index")?>">Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>