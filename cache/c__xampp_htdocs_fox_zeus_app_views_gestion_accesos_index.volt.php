<html lang="en">
    <head>
        <title>Inventario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <?= $this->getContent() ?>
        <?= $this->partial('front/title') ?>
        <?= $this->partial('front/head') ?>
        <?= $this->partial('ajax/findUsuario') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-1 col-md-offset-4">
                    <label for="fieldCodmenu">Usuario</label>
                </div>        
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <?= $this->tag->textField(['nombreUsuario', 'class' => 'form-control', 'id' => 'nombreUsuario', 'disabled' => 'true']) ?>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalUsuario" id="listaUsuarios">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <button type="button" class="btn btn-warning" id="mostrarMenuPrincipal" title="Mostrar Opciones de Menú"">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-1 col-md-offset-4">
                    <label></label>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
                    <label id="etiquetaPrincipal"></label>
                </div>
                <div  class="col-xs-12 col-sm-6 col-md-2" id="divMenuPrincipal">

                </div>

                <div id="divBotonQuitarMenuPrincipal" class="col-md-1">

                </div>
                <div id="divBotonAgregarMenuPrincipal" class="col-md-1">

                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <label id="etiquetaAsignado"></label>
                </div>
                <div  class="col-xs-12 col-sm-6 col-md-2" id="divMenuAsignado">

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-1 col-md-offset-4">
                    <label></label>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
                    <label id="etiquetaSecundaria"></label>
                </div>
                <div  class="col-xs-12 col-sm-6 col-md-2" id="divMenuSecundario">

                </div>

                <div id="divBotonAgregarMenuSecundario" class="col-md-1">

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <label id="etiquetaAsignarMenu"></label>
                </div>
                <div  class="col-xs-12 col-sm-6 col-md-2" id="divMenuSecundarioAsignado">

                </div>
            </div>
        </div>
        <?= $this->tag->hiddenField(['codUsuario']) ?>
        <?= $this->tag->hiddenField(['codSistema']) ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#listaUsuarios').on("click", function (e) {
                    e.preventDefault();
                    var params = "busquedaUsuario=" + document.getElementById("labelBusquedaUsuario").value;
                    params += "&codSistema=" + document.getElementById("codSistema").value;
                    $("#content").html("Cargando Contenido.......");
                    $.post("<?= $this->url->get('ajaxBusquedas/ajaxPostUsuarioSistema') ?>",
                            params,
                            function (data) {
                                $("#content").html(data.res.codigo);
                            }).fail(function () {
                        $("#content").html("No hay Resultados");
                    })
                });

                $('#mostrarMenuPrincipal').on("click", function (e) {
                    mostrarContenidoPrincipal();
                });
            });

            function mostrarContenidoPrincipal() {
                if (document.getElementById("codUsuario").value == "") {
                    alert("Debe seleccionar Usuario para mostrar Opciones de Menu");
                    return false;
                }
                var params = "codSistema=" + document.getElementById("codSistema").value;
                params += "&codUsuario=" + document.getElementById("codUsuario").value;
                $.post("<?= $this->url->get('GestionAccesos/ajaxMenuPrincipal') ?>",
                        params,
                        function (data) {
                            $("#etiquetaPrincipal").html("Menu Principal");
                            $("#divMenuPrincipal").html(data.res.codigo);
                            $("#divBotonAgregarMenuPrincipal").html("<button type='button' class='btn btn-warning' id='btnAgregarMenuPrincipal' title='Agregar Menu Principal' onclick='agregarMenuPrincipal();'><span class='glyphicon glyphicon-forward'></span></button>");
                            $("#divBotonQuitarMenuPrincipal").html("<button type='button' class='btn btn-warning' id='btnQuitarMenuPrincipal' title='Quitar Menu Principal' onclick='quitarMenuPrincipal();'><span class='glyphicon glyphicon-backward'></span></button>");
                            $("#etiquetaAsignado").html("Menu Asignado");
                            $("#divMenuAsignado").html(data.res.seleccionado);
                        }).fail(function () {
                    $("#etiquetaPrincipal").html("No hay Resultados");
                })
            }

            function agregarMenuPrincipal() {
                if (document.getElementById("menuPrincipal").value == "0") {
                    alert("Debe seleccionar un Menú Válido");
                    return false;
                }
                
                var params = "codSistema=" + document.getElementById("codSistema").value;
                params += "&codUsuario=" + document.getElementById("codUsuario").value;
                $.post("<?= $this->url->get('GestionAccesos/ajaxMenuPrincipal') ?>",
                        params,
                        function (data) {
                            $("#etiquetaPrincipal").html("Menu Principal");
                            $("#divMenuPrincipal").html(data.res.codigo);
                            $("#divBotonAgregarMenuPrincipal").html("<button type='button' class='btn btn-warning' id='btnAgregarMenuPrincipal' title='Agregar Menu Principal' onclick='agregarMenuPrincipal();'><span class='glyphicon glyphicon-forward'></span></button>");
                            
                            $("#etiquetaAsignado").html("Menu Asignado");
                            $("#divMenuAsignado").html(data.res.seleccionado);
                        }).fail(function () {
                    $("#etiquetaPrincipal").html("No hay Resultados");
                })
            }
        </script>
    </body>
</html>