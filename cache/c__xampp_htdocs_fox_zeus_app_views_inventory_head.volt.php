<nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav nav-tabs">
            <?php if (isset($menuPrincipal)) { ?>
                <?php foreach ($menuPrincipal as $items) { ?>
                    <?php if ($items->urlSubmenu == '#' && $items->indicadorMenuPrincipal == 'S') { ?>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <?= $items->descripcion ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (isset($menuSecundario)) { ?>
                                    <?php foreach ($menuSecundario as $secundario) { ?>
                                        <?php if ($secundario->urlSubmenu != '#' && $items->codSubMenu == $secundario->codMenuPadre) { ?> 
                                            <li><a href="<?= $secundario->urlSubmenu . '/' . $secundario->codSistema ?>"><?= $secundario->descripcion ?></a></li>
                                            <?php } ?>
                                            <?php if ($secundario->urlSubmenu == '#' && $items->codSubMenu == $secundario->codMenuPadre) { ?> 
                                                <?= $secundario->descripcion ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($items->urlSubmenu != '#' && $items->indicadorMenuPrincipal == 'S') { ?>
                        <li role="presentation"><a href="<?= $items->urlSubmenu ?>"><?= $items->descripcion ?></a></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
</nav>