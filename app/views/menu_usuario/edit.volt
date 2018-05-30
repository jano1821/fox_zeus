<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("menu", "<i class='glyphicon glyphicon-chevron-left'></i> Volver al Menu","class":"btn btn-info") }}
                    {{ link_to("usuario", "<i class='glyphicon glyphicon-chevron-left'></i> Volver Busqueda de Usuario","class":"btn btn-info") }}
                    {{ link_to("menu_usuario/new/"~codigoUsuario, "<i class='glyphicon glyphicon-plus'></i> Nuevo Vinculo","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Vinculos Menu Usuario</h4>
            </div>
            <div class="page-header">
            </div>

            {{ content() }}
            {{ form("menu_usuario/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
                        <label for="fieldCodmenu">Menu</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                {{ form.render('nombreMenu') }}
                                {{ form.render('codMenu') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldEstadoregistro">EstadoRegistro</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('estadoRegistro',['class' : 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        {{ link_to("menu_sistema/reset", "Limpiar","class":"btn btn-default") }}   
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
                params = "codUsuario=" + document.getElementById("codUsuario").value;
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

    </script>