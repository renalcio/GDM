<?
use Libs\Form;
//$Model = new \Model\ClassHub\Aula();
//var_dump($Model);
?>

<script>
    $(function(){
        $.get("<?=URL;?>handler/professor/Select2/<?=@$Model->CursoId;?>", function(data){
            $("select.ProfessorIdSelect").html(data);
            $("select.ProfessorIdSelect").val("<?=@$Model->ProfessorId;?>").change();
        });
    });
</script>

<form method="post" enctype="multipart/form-data" pasta="aulas/<?=(!empty($Model->AulaId) ? $Model->AulaId : 0
);?>">
<?
Form::ValidationSummary();
Form::Hidden("AulaId", @$Model->AulaId);
Form::Hidden("AlunoId", @$Model->AlunoId);
Form::Hidden("EscolaId", @$Model->EscolaId);
Form::Hidden("TurmaId", @$Model->TurmaId);
Form::Hidden("CursoId", @$Model->CursoId);
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Dados da Aula
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
            <div class="col-md-2">
                <div class="form-group" for="HoraDe">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "HoraDe");?>
                    </label>
                    <? Form::TimePicker("HoraDe", @$Model->HoraDe, Array("class" => "form-control"))?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group" for="HoraAte">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "HoraAte");?>
                    </label>
                    <? Form::TimePicker("HoraAte", @$Model->HoraAte, Array("class" => "form-control"))?>
                </div>
            </div>

            <div class="col-md-5" for="Compartilhado">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Compartilhado");?>
                </label><br>
                <? Form::Checkbox("Compartilhado", "1", @$Model->Compartilhado, [
                        "class" => "switch ".((@$Model->Compartilhado == 1) ? "checked" : ""),
                        "data-size" => "medium",
                        "data-off-color" => "danger",
                        "data-on-text" => "<i class='fa fa-check'></i>",
                        "data-off-text" => "<i class='fa fa-times'></i>"]
                );?>
            </div>
            </div>
        <div class="row">

            <div for="MateriaId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "MateriaId");?>
                </label>
                <? Form::Select2("MateriaId", @$Model->MateriaId, "", Array("class" => "form-control
                    MateriaIdSelect", "DataUrl" => URL."handler/materia/Select2" ))?>
            </div>

            <div for="ProfessorId" class="col-md-6">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "ProfessorId");?>
                </label>
                <? Form::Select2("ProfessorId", @$Model->ProfessorId, "", Array("class" => "form-control
                    ProfessorIdSelect", "DataUrl" => URL."handler/professor/Select2" ))?>
            </div>

        </div>
        <div class="row">

            <div class="col-md-1" for="Sala">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Sala");?>
                </label>
                <? Form::Text("Sala", @$Model->Sala, Array("class" => "form-control"))?>
            </div>

            <div class="col-md-11" for="Titulo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Titulo");?>
                </label>
                <? Form::Text("Titulo", @$Model->Titulo, Array("class" => "form-control"))?>
            </div>

        </div>
        <div class="row">


            <div class="col-md-12" for="Conteudo">
                <label>
                    <?=\Libs\ModelState::DisplayName($Model, "Conteudo");?>
                </label>
                <? Form::Wysiwyg("Conteudo", @$Model->Conteudo)?>
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
        <iframe height="400px" width="100%" src="<?=URL?>/Aula/upload/<?=$Model->AulaId?>" frameborder="0"
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
            if(!empty($Model->ListAulaArquivo) && $Model->ListAulaArquivo->Count() > 0) {
                $Model->ListAulaArquivo->For_Each(function ($item, $i) {
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