<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ {"bSortable": false}, {"bSortable": false}, null, null, null, {"bSortable": false} ],
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

    <div class="row">
    <div class="col-md-6 col-xs-12">
        <? if(!empty($Model->clsProva)){ ?>
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Próxima Prova <span class="pull-right"><?=$Model->clsProva->Data;?></span> </span>
                <span class="info-box-number"><?=$Model->clsProva->Materia->Titulo;?> <span
                        class="pull-right">Peso <?=$Model->clsProva->Peso;?></span> </span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= 100 - \Libs\Datetime::IntervaloDias(date("d/m/Y"), $Model->clsProva->Data);?>%"></div>
                </div>
                  <span class="progress-description">
                      <?=$Model->clsProva->Titulo;?>
                  </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
        <? }else{
            ?>
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próxima Prova </span>
                <span class="info-box-number">Nenhuma prova encontrada</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                  <span class="progress-description">

                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        <?
        } ?>
    </div>
        <div class="col-md-6 col-xs-12">
        <? if(!empty($Model->clsTrabalho)){ ?>
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próximo Trabalho <span class="pull-right"><?=$Model->clsTrabalho->Data;
                            ?></span> </span>
                <span class="info-box-number"><?=$Model->clsTrabalho->Materia->Titulo;?> <span
                        class="pull-right">Peso <?=$Model->clsTrabalho->Peso;?></span> </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?= 100 - \Libs\Datetime::IntervaloDias(date("d/m/Y"), $Model->clsTrabalho->Data);?>%"></div>
                    </div>
                  <span class="progress-description">
                      <?=$Model->clsTrabalho->Titulo;?>
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <? }else{ ?>
                <div class="info-box bg-gray">
                    <span class="info-box-icon"><i class="fa fa-search"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Próximo Trabalho </span>
                        <span class="info-box-number">Nenhum trabalho encontrado</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                  <span class="progress-description">
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            <?
            } ?>
        </div>

    </div>
<? } ?>
<form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Avaliações</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("Cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Nova Avaliação</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width:18px"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                <th width="10px"></th>
                <th>Titulo</th>
                <th>Data</th>
                <th>Tipo</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if($Model->Lista->Count() > 0)
            {
                $Model->Lista->For_Each(function ($Item, $i){

                    $isAutor = ($Item->AlunoId == \Libs\AlunoHelper::GetUsuarioAluno()->AlunoId) ? true : false;

                    $dataArr = explode('/', $Item->Data);
                $dataOrder = $dataArr[2].$dataArr[1].$dataArr[0];
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]"
                                   value="<?= $Item->AvaliacaoId ?>"/>
                        </td>
                        <td data-search="<?=strip_tags($Item->Descricao);?>">
                            <? if($Item->Compartilhado > 0) {?>
                                <i class="fa fa-users" data-toggle="tooltip" data-placement="top"
                                   title="Compartilhado por <?=\Libs\Helper::Abreviar($Item->Aluno->Pessoa->Nome);
                                   ?>"></i>
                        <? }else{?>
                                <i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="Não
                                compartilhado"></i>
                        <? }?>
                        </td>
                        <td><?=$Item->Titulo;?></td>
                        <td data-order="<?=$dataOrder;?>"><?=$Item->Data;?></td>
                        <td><?=($Item->Trabalho > 0) ? "Trabalho" : "Prova";?></td>
                        <td align="center">
                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("detalhes","", $Item->AvaliacaoId)?>" target="detailsFrame" onclick="$('#detailsModal').modal('show')"><i class="fa fa-eye"></i>Detalhes</a></li>

                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->AvaliacaoId)?>"><i class="fa fa-edit"></i>Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->AvaliacaoId;?>)"><i class="fa fa-trash-o"></i>
                                            Excluir</a></li>
                        </ul>
                            </div>

                        </td>
                    </tr>
                <?
                    });
            }else
            {
                echo "<tr><td colspan='5'>Nenhum Registro</td></tr>";
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
                <h4 class="modal-title" id="gridSystemModalLabel">Detalhes da Avaliação</h4>
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
