<html lang="en">
    <head>
        <title>Inventario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="js/bootstrap.min.js"></script>
        <style>      
            .embed-container {
                position: relative;
                padding-bottom: 60.25%;
                height: 0;
                width:  0;
                overflow: hidden;
            }
            .embed-container iframe {
                position: absolute;
                top:0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-user">
                                        </span> <?= $nombreUsuario ?></a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-pencil"></span><a href="#"> Ingreso de Productos</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-flash"></span><a href="#"> Salida de Productos</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-log-out"></span><?= $this->tag->linkTo(['menu', ' Volver al Menú']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-off"></span><?= $this->tag->linkTo(['index/logout', ' Cerrar Sesión']) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
                                        </span> Productos</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-barcode"></span><?= $this->tag->linkTo(['producto/index', ' Registrar Productos', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-tags"></span><?= $this->tag->linkTo(['categoria/index', ' Categorias', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-book"></span><?= $this->tag->linkTo(['modelo/index', ' Modelos', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-bookmark"></span><?= $this->tag->linkTo(['marca/index', ' Marcas', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-leaf"></span><?= $this->tag->linkTo(['unidad_medida/index', ' Unidades de Medida', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-hdd">
                                        </span> Almacen</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-object-align-bottom"></span><?= $this->tag->linkTo(['almacen/index', ' Almacenes', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-object-align-horizontal"></span><?= $this->tag->linkTo(['sector/index', ' Sectores', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-object-align-vertical"></span><?= $this->tag->linkTo(['zona/index', ' Zonas', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-object-align-right"></span><?= $this->tag->linkTo(['seccion/index', ' Secciones', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-pushpin"></span><?= $this->tag->linkTo(['ubicacion/index', ' Ubicación', 'target' => 'iframe_inventory']) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                                        </span>Reportes</a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-list-alt"></span><a href="#"> Productos por Almacén</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-usd"></span><a href="#"> Precios por Producto</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="embed-container">
                    <iframe width="660" height="335" name="iframe_inventory" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </body>
</html>
