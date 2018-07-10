<nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Gestión <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Ingreso de Productos</a></li>
                    <li><a href="#">Salida de Productos</a></li>
                </ul>

            </li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Administración de Productos <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><?= $this->tag->linkTo(['producto/index', ' Productos']) ?></li>
                    <li><?= $this->tag->linkTo(['categoria/index', ' Categorias']) ?></li>
                    <li><?= $this->tag->linkTo(['modelo/index', ' Modelos']) ?></li>
                    <li><?= $this->tag->linkTo(['marca/index', ' Marcas']) ?></li>
                    <li><?= $this->tag->linkTo(['unidad_medida/index', ' Unidades de Medida']) ?></li>
                </ul>

            </li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Administración de Almacenes <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Almacenes</a></li>
                    <li><a href="#">Sectores</a></li>
                    <li><a href="#">Zonas</a></li>
                    <li><a href="#">Secciones</a></li>
                    <li><a href="#">Ubicación</a></li>
                </ul>

            </li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Reportes <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Productos por Almacén</a></li>
                    <li><a href="#">Precios por Producto</a></li>
                </ul>

            </li>
            <li role="presentation"><?= $this->tag->linkTo(['menu', ' Volver al Menú']) ?></li>
            <li role="presentation"><?= $this->tag->linkTo(['index/logout', ' Cerrar Sesión']) ?></li>
        </ul>
    </div>
</nav>