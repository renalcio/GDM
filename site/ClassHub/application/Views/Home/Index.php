<?
use Libs\ArrayHelper;
use DAL\Site;
use Libs\Helper;
?>
<div class="row">
</div>

<div class="row">
    <div class="col-md-5">
        <h3>Avisos</h3>
        <div id="grid" class="row">
            <div class="col-md-12">
                <?
                if($Model->ListAviso->Count() > 0)
                {
                    $Model->ListAviso->For_Each(function ($Item, $i){
                        ?>
                        <a href="#" data-toggle="modal" data-target="#modelAviso_<?=$i;?>">
                        <div class="callout callout-<?=$Item->Tipo;?>" style="word-wrap:break-word;">
                            <h4><?=$Item->Titulo;?></h4>
                            <p><?=Helper::Limitar(nl2br($Item->Descricao), 150);?></p>
                        </div>
                        </a>

                        <div class="modal fade" id="modelAviso_<?=$i;?>" tabindex="-1" role="dialog"
                             aria-labelledby="modelAvisoTitulo_<?=$i;?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="modelAvisoTitulo_<?=$i;?>"><?=$Item->Titulo;?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?=nl2br($Item->Descricao);?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?
                    });
                }else
                {
                    echo "<div class='well'>Nenhum aviso</div>";
                }
                ?>
                <a href="<?=Helper::getUrl("index", "aviso");?>" class="btn btn-primary pull-right">Ver Todos</a>
            </div>
        </div></div>
    <div class="col-md-7"></div>
</div>
<h3>Calendário de Avaliações</h3>
<div class="row">
    <div class="col-md-7"><?  Helper::LoadView("index", "calendario");?></div>
    <div class="col-md-5">
        <? if($Model->ListAvaliacao->Count() > 0){
            $Model->ListAvaliacao->For_Each(function($item, $i){
                $porc = 100 - \Libs\Datetime::IntervaloDias(date("d/m/Y"), $item->Data);
                ?>
                <div class="info-box <?=($porc > 100) ? "bg-gray" : (($item->Trabalho > 0) ? "bg-yellow" : "bg-red");
                ?>">
                            <span class="info-box-icon"><i class="ion <?=($item->Trabalho > 0) ? "ion-ios-copy-outline" :
                                    "ion-ios-list-outline";
                                ?>"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text"><?=($item->Trabalho > 0) ? "Trabalho" : "Prova";?> <span class="pull-right"><?=$item->Data;?></span> </span>
                <span class="info-box-number"><?=$item->Materia->Titulo;?> <span
                        class="pull-right">Peso <?=$item->Peso;?></span> </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $porc;?>%"></div>
                        </div>
                  <span class="progress-description">
                      <?=$item->Titulo;?>
                  </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            <?
            });?>

        <? }else{ ?>
            <div class="info-box bg-gray">
                <span class="info-box-icon"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Proximos trabalhos e provas </span>
                    <span class="info-box-number">Nenhum trabalho ou prova encontrado</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                  <span class="progress-description">
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        <?
        } ?></div>
</div>
