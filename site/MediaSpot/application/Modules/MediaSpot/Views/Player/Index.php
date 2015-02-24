<?php
//var_dump($Model);
//$Model = new \DAL\MediaSpot\Player();
if(isset($Model)&& !empty($Model)){
    ?>
    <script type="text/javascript">
        $(function(){
            $("#listagem").dataTable({
                "processing": true,
                "serverSide": true,
                "ordering":  false,
                "info": false,
                "ajax": {
                    "url": "<?=URL?>handler/musica/Consulta/<?=$Model->Artista->ArtistaId;?>",
                    "type": "POST"
                },
                "columns": [
                    {"data": "Titulo" },
                    {   "data": "OptionsMenu",
                        "orderable":      false,
                        "className": "tdMenu"
                    }
                ]
                //"aoColumns": [ null, null, {"bSortable": false} ]
            });
        });
        </script>
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body" style="background: url(<?=$Model->Artista->Imagem;?>) no-repeat;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 200px;">
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"><?=$Model->Artista->Titulo;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?=$Model->Artista->Descricao;?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Músicas - Datatables</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <table id="listagem" class="table table-bordered table-hover">
                        <thead style="display:none">
                        <tr>
                        <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        if($Model->ListMusica->Count() > 0) {
                            $Model->ListMusica->For_Each(function ($Item) {
                                //$Item = new \DAL\Musica();
                                //var_dump($Item);
                                ?>
                                <tr>
                                    <td><?=$Item->Titulo;?></td>
                                    <td align="center">

                                        <div class="btn-group">
                                            <i class="fa fa-bars" class="dropdown-toggle"
                                               data-toggle="dropdown"></i>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->MusicaId)?>"><i
                                                            class="fa fa-edit"></i>
                                                        Editar</a></li>
                                                <li><a onclick="Excluir(<?=@$Item->MusicaId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                                        </div>

                                    </td>
                                </tr>
                            <?
                            });
                        }else
                        {
                            // echo "<tr><td colspan='2'>Nenhum Registro</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
    </div>
<? } ?>