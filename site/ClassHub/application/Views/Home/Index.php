<?
use Libs\ArrayHelper;
use DAL\Site;
use Libs\Helper;
?>
<div class="row">
</div>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6"></div>
</div>
<div class="row">
    <div class="col-md-7"><?  Helper::LoadView("index", "calendario");?></div>

    <div class="col-md-5">
        <? if($Model->ListAvaliacao->Count() > 0){
            $Model->ListAvaliacao->For_Each(function($item, $i){
                ?>
                <div class="info-box <?=($item->Trabalho > 0) ? "bg-yellow" : "bg-red";?>">
                            <span class="info-box-icon"><i class="ion <?=($item->Trabalho > 0) ? "ion-ios-copy-outline" :
                                    "ion-ios-list-outline";
                                ?>"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text"><?=($item->Trabalho > 0) ? "Trabalho" : "Prova";?> <span class="pull-right"><?=$item->Data;
                            ?></span> </span>
                <span class="info-box-number"><?=$item->Materia->Titulo;?> <span
                        class="pull-right">Peso <?=$item->Peso;?></span> </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= 100 - \Libs\Datetime::IntervaloDias(date("d/m/Y"), $item->Data);?>%"></div>
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
