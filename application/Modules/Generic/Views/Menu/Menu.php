<?php
$controle = Libs\Helper::getController();
function LoadMenuObj($Pai = 0)
{
    $pdo = new Libs\Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $menu = $pdo->select("SELECT * FROM ".DB_NAME.".Menu
                                        WHERE AplicacaoId='" . APP_ID . "'
                                        AND Pai = '$Pai'
                                        ORDER BY Posicao ASC", new stdClass(), true);

    if (is_array($menu) && count($menu) > 0) {
        for ($i = 0; $i < count($menu); $i++) {
            $menu[$i]->ListSubMenu = LoadMenuObj($menu[$i]->MenuId);
        }
    }

    return $menu;
}
$menu = LoadMenuObj();
//print_r($menu);
?>

<?php
if(isset($menu) && is_array($menu) && count($menu) > 0)
{
    ?>
    <ul class="nav nav-sidebar">
        <?
        $ref = -1;
        foreach ($menu as $MenuItem) {
            if (Libs\UsuarioHelper::GetAcessoByUsuarioId($MenuItem->MenuId)) {
                $ref++;
                $classSubmenu = '';
                if (isset($MenuItem->ListSubMenu) && is_array($MenuItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                    $classSubmenu = 'class="nav-parent"';
                ?>

                <li <?= $classSubmenu ?> >
                    <a href="<?= URL . $MenuItem->Url; ?>">
                        <i class="fa <?= $MenuItem->Icone; ?>"></i> <span><?= $MenuItem->Titulo; ?></span>
                        <? if (!empty($classSubmenu)) { ?>
                            <span class="fa arrow"></span>
                        <? } ?>

                    </a>
                    <?
                    if (isset($MenuItem->ListSubMenu) && is_array($MenuItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0) {
                        ?>
                        <ul class="children collapse">
                            <?php
                            foreach ($MenuItem->ListSubMenu as $SubItem) {
                                if (Libs\UsuarioHelper::GetAcessoByUsuarioId($SubItem->MenuId)) {
                                    $ref++;
                                    $classSubmenu = '';
                                    if (isset($SubItem->ListSubMenu) && is_array($SubItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0)
                                        $classSubmenu = 'class="nav-parent"';
                                    ?>

                                    <li <?= $classSubmenu ?> >
                                        <a href="<?= URL . $SubItem->Url; ?>">
                                            <? if (!empty($SubItem->Icone)) { ?>
                                                <i class="fa <?= $SubItem->Icone; ?>"></i>
                                            <? } else { ?>
                                                <i class="fa fa-circle-o"></i>
                                            <? } ?>
                                            <span><?= $SubItem->Titulo; ?></span>
                                            <? if (!empty($classSubmenu)) { ?>
                                                <span class="fa arrow"></span>
                                            <? } ?>
                                        </a>
                                        <?php
                                        if (isset($SubItem->ListSubMenu) && is_array($SubItem->ListSubMenu) && count($MenuItem->ListSubMenu) > 0) {
                                            ?>
                                            <ul class="children collapse">
                                                <?php
                                                foreach ($SubItem->ListSubMenu as $SubSubItem) {
                                                    if (Libs\UsuarioHelper::GetAcessoByUsuarioId($SubSubItem->MenuId)) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= URL . $SubSubItem->Url; ?>">
                                                                <?=$SubSubItem->Titulo; ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php }
                            }?>
                        </ul>
                    <?php } ?>
                </li>
            <?php }
        }?>

    </ul>
<?
}
?>



