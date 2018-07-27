<html lang="en">
    <head>
        <title>Inventario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        {{ content() }}
        {{ partial("front/title") }}
        {{ partial("front/head") }}
        {{ partial("ajax/findUsuario") }}
        <div class="form-group">
            <div class="col-md-3">
            </div>
            <div class="col-md-2">
                <label for="fieldCodmenu">Usuario</label>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        {{ text_field("nombreUsuario", "class" : "form-control", "id" : "nombreUsuario", "disabled" : "true") }}
                        {{ hidden_field("codUsuario") }}
                        {{ hidden_field("codSistema") }}
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalUsuario" id="listaUsuarios">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-warning" id="mostrarMenuPrincipal">
                            <span class="glyphicon glyphicon-option-horizontal"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header">
        </div>
        <div class="form-group">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
                <label id="etiquetaPrincipal"></label>
            </div>
            <div  class="col-md-3" id="divMenuPrincipal">

            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
                <label id="etiquetaAsignado"></label>
            </div>
            <div  class="col-md-3" id="divMenuAsignado">

            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#listaUsuarios').on("click", function (e) {
                    e.preventDefault();
                    var params = "busquedaUsuario=" + document.getElementById("labelBusquedaUsuario").value;
                    params += "&codSistema=" + document.getElementById("codSistema").value;
                    $("#content").html("Cargando Contenido.......");
                    $.post("{{ url('ajaxBusquedas/ajaxPostUsuarioSistema') }}",
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
                $.post("{{ url('GestionAccesos/ajaxMenuPrincipal') }}",
                        params,
                        function (data) {
                            $("#etiquetaPrincipal").html("Menu Principal");
                            $("#divMenuPrincipal").html(data.res.codigo);
                            $("#etiquetaAsignado").html("Menu Asignado");
                            $("#divMenuAsignado").html(data.res.seleccionado);
                        }).fail(function () {
                    $("#etiquetaPrincipal").html("No hay Resultados");
                })
            }
        </script>
    </body>
</html>