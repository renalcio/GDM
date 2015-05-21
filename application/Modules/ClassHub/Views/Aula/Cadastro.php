<?
use Libs\Form;
//$Model = new \DAL\ClassHub\Aula();
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

            $.get("<?=URL;?>handler/professor/Select2/"+id, function(data){
                $("select.ProfessorIdSelect").html(data);
                $("select.ProfessorIdSelect").val("<?=@$Model->ProfessorId;?>").change();
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
    });
</script>

<h3 class="page-header">Cadastro de Aula</h3>

<form method="post" enctype="multipart/form-data" id="fileupload" pasta="<?=(!empty($Model->AulaId) ? $Model->AulaId : 0
);?>">
    <?
    Form::ValidationSummary();
    Form::Hidden("AulaId", @$Model->AulaId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Dados da Aula
            </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" for="Data">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "Data");?>
                        </label>
                        <? Form::DatePicker("Data", @$Model->Data, Array("class" => "form-control"))?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" for="HoraDe">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "HoraDe");?>
                        </label>
                        <? Form::TimePicker("HoraDe", @$Model->HoraDe, Array("class" => "form-control"))?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" for="HoraAte">
                        <label>
                            <?=\Libs\ModelState::DisplayName($Model, "HoraAte");?>
                        </label>
                        <? Form::TimePicker("HoraAte", @$Model->HoraAte, Array("class" => "form-control"))?>
                    </div>
                </div>

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
                <div for="ProfessorId" class="col-md-4">
                    <label>
                        <?=\Libs\ModelState::DisplayName($Model, "ProfessorId");?>
                    </label>
                    <? Form::Select2("ProfessorId", @$Model->ProfessorId, "", Array("class" => "form-control
                    ProfessorIdSelect", "DataUrl" => URL."handler/professor/Select2" ))?>
                </div>

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

    <!-- The file upload form used as target for the file upload widget -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Arquivos
            </h3>
        </div>
        <div class="box-body">
            <!-- Redirect browsers with JavaScript disabled to the origin page
            <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
             The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
                <div class="col-lg-7">

                    <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Adicionar Arquivos...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Iniciar Envio</span>
                    </button>
                    <button type="reset" class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancelar Envio</span>
                    </button>
                    <button type="button" class="btn btn-danger delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Apagar</span>
                    </button>

                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped">
                <thead>
                <tr>
                    <td>
                        <input type="checkbox" class="toggle">
                    </td>
                    <td></td>
                    <td>Arquivo</td>
                    <td>Titulo</td>
                    <td>Tamanho</td>
                    <td>Apagar</td>
                </tr>
                </thead>
                <tbody class="files"></tbody>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a type="submit" class="btn btn-danger btn-sm" href="<?=\Libs\Helper::getUrl("index"); ?>" >Cancelar</a>   <button type="submit" class="btn btn-primary btn-sm pull-right">Salvar</button></div>
    </div>
</form>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processando...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Iniciar</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
    <td>
     {% if (file.deleteUrl) { %}
     <input type="checkbox" name="delete" value="1" class="toggle">
     {% } %}
    </td>
        <td>
        <input type="hidden" name="arquivo[{%=i%}][url]" value="{%=file.url%}" />
            <span class="preview">
            <a class="btn btn-success btn-sm" href="{%=file.url%}" title="{%=file.name%}" target="_blank" download="{%=file.url%}"><i class="fa fa-download"></i></a>
                {% if (file.thumbnailUrl) { %}
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalFile_{%=i%}">
  <i class="fa fa-search-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="ModalFile_{%=i%}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{%=file.name%}</h4>
      </div>
      <div class="modal-body">
        <img style="width: 100%; height: auto;" src="{%=file.url%}">
      </div>
    </div>
  </div>
</div>

                {% } %}
            </span>
        </td>
        <td>
        <p class="name">
            <span>{%=file.name%}</span>
        </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <input type="text" class="form-control" name="arquivo[{%=i%}][titulo]" value="{%=file.name%}" />
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Apagar</span>
                </button>

            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>