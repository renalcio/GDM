<?php
//var_dump($Model);
//$Model = new \Model\MediaSpot\Busca();
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#artista" data-toggle="tab">Artistas</a></li>
        <li><a href="#musica" data-toggle="tab">Músicas</a></li>
        <li class="pull-left header"><i class="fa fa-search"></i> Resultados</li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="artista">
            <div class="row">
                <div class="form-group col-lg-12">
                    <div class="list-group">
                        <?
                        if($Model->ListArtista->Count() > 0) {
                            $Model->ListArtista->For_Each(function ($item) {
                                //var_dump($item);
                                ?>
                                <a href="<?=\Libs\Helper::getUrl("","Player", @$item->ArtistaId);?>" class="list-group-item"><?=@$item->Titulo;?></a>
                            <?
                            });
                        }else{
                            echo '<a href="#" class="list-group-item disabled">Nenhum Resultado</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="musica">
            <div class="row">
                <div class="form-group col-lg-12">
                    <div class="list-group">
                        <?
                        if($Model->ListMusica->Count() > 0) {
                            $Model->ListMusica->For_Each(function ($item) {
                                //var_dump($item);
                                ?>
                                <a href="<?=\Libs\Helper::getUrl("","Player", @$item->ArtistaId);?>" class="list-group-item"><?=@$item->Titulo;?></a>
                            <?
                            });
                        }else{
                            echo '<a href="#" class="list-group-item disabled">Nenhum Resultado</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
</div>