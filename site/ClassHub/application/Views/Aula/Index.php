<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ {"bSortable": false}, {"bSortable": false},  null, null, null, null, null, {"bSortable": false} ],
                "fnDrawCallback" : function() {
                    iChecks();
                },
                "order": [[ 2, "asc" ]]
            });
        });

        function iChecks(){
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck('destroy');
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $(".chkDeleteAll").on('ifChecked', function(event){
                $(".chkDelete").iCheck('check');
            });

            $(".chkDeleteAll").on('ifUnchecked', function(event){
                $(".chkDelete").iCheck('uncheck');
            });
        }
        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }
    </script>
<? } ?>
<form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Aula</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("Cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Nova Aula</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width:18px"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                <th width="10px"></th>
                <th>Materia</th>
                <th>Professor</th>
                <th>Data</th>
                <th>De</th>
                <th>Até</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if($Model->Lista->Count() > 0)
            {
                $Model->Lista->For_Each(function ($Item, $i){

                    $dataArr = explode('/', $Item->Data);
                    $dataOrder = $dataArr[2].$dataArr[1].$dataArr[0];
                    ?>
                    <tr>
                        <td><input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]"
                                   value="<?= $Item->AulaId ?>"/></td>
                        <td data-search="<?=strip_tags($Item->Conteudo);?>">
                            <? if($Item->Compartilhado > 0) {?>
                                <i class="fa fa-users" data-toggle="tooltip" data-placement="top"
                                   title="Compartilhado por <?=\Libs\Helper::Abreviar($Item->Aluno->Pessoa->Nome);
                                   ?>"></i>
                            <? }else{?>
                                <i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="Não
                                compartilhado"></i>
                            <? }?>
                        </td>
                        <td><?=$Item->Turma->Semestre."S ".$Item->Turma->Ano." - ".$Item->Turma->Turno." - ".$Item->Turma->Curso->Titulo;?></td>
                        <td><?=$Item->Professor->Pessoa->Nome;?></td>
                        <td><?=$Item->Data;?></td>
                        <td><?=$Item->HoraDe;?></td>
                        <td><?=$Item->HoraAte;?></td>
                        <td align="center">
                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("detalhes","", $Item->AulaId)?>" target="detailsFrame" onclick="$('#detailsModal').modal('show')"><i class="fa fa-eye"></i>Detalhes</a></li>
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->AulaId)?>"><i class="fa fa-edit"></i>Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->AulaId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                            </div>

                        </td>
                    </tr>
                <?
                    });
            }else
            {
                echo "<tr><td colspan='10'>Nenhum Registro</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</button>
    </div>
</div>
</form>

<!-- Large modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Detalhes da Aula</h4>
            </div>
            <div class="modal-body">
                <iframe height="400px" width="100%" src="" frameborder="0"
                        scrolling="no" id="detailsFrame" name="detailsFrame"></iframe>
                <script>
                    $(function(){
                        var altura = $(window).height() - 200;
                        $("#detailsFrame").height(altura);
                    });
                </script>
        </div>
        </div>
    </div>
</div>

