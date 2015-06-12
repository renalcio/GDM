<?
use Libs\Form;
//$Model = new \Model\ClassHub\Avaliacao();
//var_dump($Model);
?>

<script>
    $(function(){
        $("#EscolaId").change(function(){
            var id = $(this).val();
            $.get("<?=URL;?>handler/curso/Select2/"+id, function(data){
                $("select.CursoIdSelect").html(data);
                $("select.CursoIdSelect").val("<?=@$Model->CursoId;?>").change();
            });


        });
        $("#CursoId").change(function(){
            var id = $(this).val();
            $.get("<?=URL;?>handler/materia/Select2/"+id, function(data){
                $("select.MateriaIdSelect").html(data);
                $("select.MateriaIdSelect").val("<?=@$Model->MateriaId;?>").change();
            });

            $.get("<?=URL;?>handler/turma/Select2/"+id, function(data){
                $("select.TurmaIdSelect").html(data);
                $("select.TurmaIdSelect").val("<?=@$Model->TurmaId;?>").change();
            });
        });

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>

<form method="post" enctype="multipart/form-data">
<?
Form::ValidationSummary();
Form::Hidden("AvaliacaoId", @$Model->AvaliacaoId);
Form::Hidden("AlunoId", @$Model->AlunoId);
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Dados da Avaliação
        </h3>
    </div>
    <div class="box-body">

            <div class="row">
            <div class="col-md-3">
                <div class="form-group" for="Data">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                    </label>
                    <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                </div>
            </div>
            <div class="col-md-9" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>
            </div>
        <div class="row">
            <div for="EscolaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "EscolaId");?>
                </label>
                <? Form::Select2("EscolaId", @$Model->EscolaId, "", Array("class" => "form-control EscolaIdSelect", "DataUrl" => URL."handler/escola/Select2" ))?>
            </div>
            <div for="CursoId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "CursoId");?>
                </label>
                <? Form::Select2("CursoId", @$Model->CursoId, "", Array("class" => "form-control CursoIdSelect", "DataUrl" => URL."handler/curso/Select2" ))?>
            </div>

            <div for="MateriaId" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "MateriaId");?>
                </label>
                <? Form::Select2("MateriaId", @$Model->MateriaId, "", Array("class" => "form-control
                    MateriaIdSelect", "DataUrl" => URL."handler/materia/Select2" ))?>
            </div>

            <div for="TurmaId" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "TurmaId");?>
                </label>
                <? Form::Select2("TurmaId", @$Model->TurmaId, "", Array("class" => "form-control TurmaIdSelect",
                    "DataUrl" => URL."handler/turma/Select2" ))?>
            </div>

            <div for="Trabalho" class="col-md-4">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Trabalho");?>
                </label>
                <div class="row">
                    <div class="col-sm-6">
                        <? Form::Radio("Trabalho", "0", @$Model->Trabalho, ["class" => "minimal"])?>
                         Prova
                    </div>
                    <div class="col-sm-6">
                        <? Form::Radio("Trabalho", "1", @$Model->Trabalho, ["class" => "minimal"])?> Trabalho
                    </div>
                </div>

            </div>

            <div class="col-md-12" for="Descricao">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Descricao");?>
                </label>
                <? Form::Wysiwyg("Descricao", @$Model->Descricao)?>
            </div>
        </div>
    </div>

</div>



<br>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Meus Arquivos
            </h3>
        </div>
        <div class="box-body">
<iframe height="400px" width="100%" src="<?=URL?>/Avaliacao/upload/<?=$Model->AvaliacaoId?>" frameborder="0"
        scrolling="no" id="uploadFrame"></iframe>
            <script>
                function renderModal(selector, html, options) {
                    var parent = "div#FrameModals",
                        $this = $(parent).find(selector);

                    options = options || {};
                    options.width = options.width || 'auto';

                    if ($this.length == 0) {
                        var selectorArr = selector.split(".");
                        var $wrapper = $('<div class="modal fade ' + selectorArr[selectorArr.length-1] + '" tabindex="-1" role="dialog" aria-hidden="true"></div>').append(html);
                        $this = $wrapper.appendTo(parent);
                        $this.modal("show");
                    } else {
                        $this.html(html).modal("show");
                    }


                }
            </script>
            <div id="FrameModals">

            </div>
    </div>
    </div>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Outros Arquivos
        </h3>
    </div>
    <div class="box-body">
        <table id="tbOutrosArquivos" class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Arquivo</th>
                <th>Autor</th>
                <th>Tamanho</th>
            </tr>
            </thead>
            <tbody>
            <?
            if(!empty($Model->ListAvaliacaoArquivo) && $Model->ListAvaliacaoArquivo->Count() > 0) {
                $Model->ListAvaliacaoArquivo->For_Each(function ($item, $i) {
                    ?>
                    <tr>
                        <td><a class="btn btn-success btn-sm" href="<?= $item->Url; ?>" title="<?= $item->Titulo; ?>"
                               target="_blank" download="<?= $item->Url; ?>"><i class="fa fa-download"></i></a>
                            <? if ($item->img == true) { ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#ModalFileB_<?= $i; ?>">
                                    <i class="fa fa-search-plus"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="ModalFileB_<?= $i; ?>" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Fechar"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title"><?= $item->Titulo; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <img style="width: 100%; height: auto;" src="<?= $item->Url; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                        </td>
                        <td><?= $item->Titulo; ?></td>
                        <td>
                            <?= $item->Pessoa->Nome; ?>
                        </td>
                        <td><?= $item->Tamanho; ?></td>
                    </tr>
                <?
                });
            }else{
                ?>
                <td colspan="4">Nenhum Arquivo</td>
            <?
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
</div>
</form>