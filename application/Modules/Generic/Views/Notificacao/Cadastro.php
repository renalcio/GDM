<?
use Libs\Form;
$Model = new \DAL\Notificacao();
?>
<h3 class="page-header">Cadastro de Actions</h3>
<form method="post">
    <?Form::Hidden("NotificacaoId", @$Model->NotificacaoId);?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Informações da Notificação
            </h3>
        </div>
        <div class="box-body">
            <? if(APPID == ROOTAPP){ ?>
            <div class="form-group" for="AplicacaoId">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "AplicacaoId");?>
                </label>
                <? Form::Select2("ModuloId", @$Model->AplicacaoId, "", Array("class" => "form-control AplicacaoSelect",
                    "DataUrl" => URL."handler/Aplicacao/Select2" ))?>
            </div>
        <? }else{
                Form::Hidden("AplicacaoId", APPID);
            }
            ?>
            <div class="form-group" for="Conteudo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Conteudo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Conteudo, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Icone">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Icone");?>
                </label>
                <? Form::Text("Icone", @$Model->Icone, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Classe">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Classe");?>
                </label>
                <? Form::Text("Classe", @$Model->Classe, Array("class" => "form-control"))?>
            </div>

            <div class="form-group" for="Data">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                </label>
                <? Form::Text("Data", @$Model->Data, Array("class" => "form-control"))?>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>