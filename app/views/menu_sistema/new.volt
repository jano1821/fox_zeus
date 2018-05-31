<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("menu_sistema/index/"~codigoUsuario, "<i class='glyphicon glyphicon-chevron-left'></i> Volver a Búsqueda","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-record'></i>Nuevo Vinculo Menu Sistema</h4>
            </div>

            <div class="page-header">
            </div>

            {{ content() }}
            {{ partial("ajax/findMenu") }}
            {{ partial("ajax/findSistema") }}
            {{ form("menu_sistema/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

            <div class="table">

                <div class="form-group">
                    <h3>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            {{ form.render('codUsuario') }}
                        </div>
                        <div class="col-md-6">
                            <div class="label label-success">
                                <label for="usuario">{{ usuario }}</label>
                            </div>
                        </div>
                    </h3>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCodmenu" class="col-sm-2 control-label">Menu</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                {{ form.render('nombreMenu') }}
                                {{ form.render('codMenu') }}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalMenu" id="listaMenu">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCodsistema" class="col-sm-2 control-label">Sistema</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                {{ form.render('nombreSistema') }}
                                {{ form.render('codSistema') }}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalSistema" id="listaSistemas">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{ form.render('codUsuario') }}

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        {{ form.render('save') }}
                        {{ form.render('csrf', ['value': security.getToken()]) }}
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#listaMenu').on("click", function (e) {
                e.preventDefault();
                var params = "busquedaMenu=" + document.getElementById("labelBusquedaMenu").value;
                params += "&codUsuario=" + document.getElementById("codUsuario").value;
                $("#contentMenu").html("Cargando Contenido.......");
                $.post("{{ url('AjaxBusquedas/ajaxPostMenu') }}",
                        params,
                        function (data) {
                            $("#contentMenu").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentMenu").html("No hay Resultados");
                })
            });
        });

        $(document).ready(function () {
            $("#listaSistemas").click(function (e) {
                e.preventDefault();
                    var params = "busquedaSistema=" + document.getElementById("labelBusquedaSistema").value;
                    params += "&codUsuario=" + document.getElementById("codUsuario").value;
                    params += "&codMenu=" + document.getElementById("codMenu").value;
                    $("#contentSistema").html("Cargando Contenido.......");
                    $.post("{{ url('AjaxBusquedas/ajaxPostMenuSistema') }}",
                            params,
                            function (data) {
                                $("#contentSistema").html(data.res.codigo);
                            }).fail(function () {
                        $("#contentSistema").html("No hay Resultados");
                    })
            });
        });


    </script>