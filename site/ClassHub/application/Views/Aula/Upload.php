<?
use Libs\Form;
//$Model = new \Model\ClassHub\Aula();
//var_dump($Model);
?>
<script>
    $(function(){
        $('#uploadedFiles').slimScroll({
            height: '270px'
        });
    });
</script>
<form method="post" enctype="multipart/form-data" id="fileupload" pasta="ClassHub/aulas/<?=(!empty($Model->AulaId) ? $Model->AulaId : 0
);?>">
    <?
    Form::Hidden("AulaId", @$Model->AulaId);
    Form::Hidden("AlunoId", @$Model->AlunoId);
    ?>

    <!-- The file upload form used as target for the file upload widget -->

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
    <div id="uploadedFiles">
            <table role="presentation" class="table table-striped">
                <thead style=" position: fixed; margin-top: -40px;">
                <tr>
                    <th><input type="checkbox" class="togglePrincipal"></th>
                    <th></th>
                    <th>Arquivo</th>
                    <th>Tamanho</th>
                    <th>Apagar</th>
                </tr>
                </thead>
                <tbody class="files"></tbody>
            </table>
    </div>
</form>
<script>
    $(function(){
        setTimeout(function(){
            $("#uploadedFiles table tbody td").each(function(i, item){
                var largura = $(this).width();
                $("#uploadedFiles table thead th:eq("+i+")").width(largura);
                console.log(largura);
            });

            $(".togglePrincipal").change(function(){
               var check = $(this).prop("checked");
                $(".toggle").prop("checked", check);
            });
            $(".toggle").change(function(){
                var checados = $(".toggle:checked").size(),
                    checks = $(".toggle").size();
                if(checados >= checks && $(".togglePrincipal").prop("checked") != true){
                    $(".togglePrincipal").prop("checked", true);
                }else if(checados < checks && $(".togglePrincipal").prop("checked") == true){
                    $(".togglePrincipal").prop("checked", false);
                }
            });

            $(".ModalPreviewFile").click(function(){
                var Titulo = $(this).attr("titulo");
                var Url = $(this).attr("url");
                var i = $(this).attr("i");
                var mHtml = '<div class="modal-dialog modal-lg">\
                                <div class="modal-content">\
                                    <div class="modal-header">\
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>\
                                        <h4 class="modal-title">'+Titulo+'</h4>\
                                    </div>\
                                    <div class="modal-body">\
                                        <img style="width: 100%; height: auto;" src="'+Url+'">\
                                    </div>\
                                </div>\
                            </div>';
                window.parent.renderModal(".ModalPreviewFile_"+i, mHtml);
            });
        }, 500);
    });
</script>
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
<button type="button" class="btn btn-primary btn-sm ModalPreviewFile" data-toggle="modal"
data-target="#ModalFile_{%=i%}" titulo="{%=file.name%}" url="{%=file.url%}" i="{%=i%}">
  <i class="fa fa-search-plus"></i>
</button>

<!-- Modal -->


                {% } %}
            </span>
        </td>
        <td>
        <p class="name">
            <span>{%=file.name%}</span>
        </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Erro</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}&pasta=aulas/<?=(!empty($Model->AulaId) ? $Model->AulaId : 0
    );?>"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
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