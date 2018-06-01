<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("usuario", "<i class='glyphicon glyphicon-chevron-left'></i> Volver a Búsqueda","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i>Nuevo Usuario</h4>
            </div>

            <div class="page-header">
            </div>

            {{ content() }}
            {{ partial("ajax/findEmpresa") }}
            {{ partial("ajax/findPersona") }}
            {{ partial("ajax/findAgencia") }}

            <?php require_once('files/datosSesion.php');?>

            {{ form("usuario/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

            <div class="table">

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCodPersonaUsuario" class="col-sm-2 control-label">Persona</label>
                    </div>
                    <div class="col-md-4">
                        {{ form.render('codPersona') }}
                        {{ form.render('nombrePersona') }}
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalPersona" id="listaPersona">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
                    
                {% if superAdmin == "Z" %}
                    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <label for="fieldCodempresa" class="col-sm-2 control-label">Empresa</label>
                        </div>
                        <div class="col-md-4">
                            {{ form.render('codEmpresa') }}
                            {{ form.render('nombreEmpresa') }}
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalEmpresas" id="listaEmpresa">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                {% endif %}
                
                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCodagencia" class="col-sm-2 control-label">Agencia</label>
                    </div>
                    <div class="col-md-4">
                        {{ form.render('codAgencia') }}
                        {{ form.render('nombreAgencia') }}
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalAgencia" id="listaAgencia">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldNombreusuario" class="col-sm-2 control-label">Usuario</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('nombreUsuario') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldPasswordusuario" class="col-sm-2 control-label">Password</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('passwordUsuario') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldIndicadorusuarioadministrador" class="col-sm-2 control-label">Administrador</label>
                    </div>
                    <div class="col-md-3">
                        <?php
                        if ($indicadorUsuarioAdministrador=='Z'){
                        ?>
                        {{ select_static('indicadorUsuarioAdministrador', [ '' : 'Selecciona Privilegios...', 'Z' : 'Super Administrador', 'S' : 'Administrador', 'N' : 'No Administrador'],'class':'form-control') }}
                        <?php
                        }else{
                        ?>
                        {{ select_static('indicadorUsuarioAdministrador', [ '' : 'Selecciona Privilegios...', 'S' : 'Administrador', 'N' : 'No Administrador'],'class':'form-control') }}
                        <?php
                        }
                        ?>
                    </div>
                </div>

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
            $('#listaPersona').on("click", function (e) {
                e.preventDefault();
                var params = "busquedaPersona=" + document.getElementById("labelBusquedaPersona").value;
                $("#contentPersona").html("Cargando Contenido.......");
                $.post("{{ url('AjaxBusquedas/ajaxPostPersona') }}",
                        params,
                        function (data) {
                            $("#contentPersona").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentPersona").html("No hay Resultados");
                })
            });
        });
        $(document).ready(function () {
            $('#listaEmpresa').on("click", function (e) {
                e.preventDefault();
                var params = "busquedaEmpresa=" + document.getElementById("labelBusquedaEmpresa").value;
                $("#contentEmpresa").html("Cargando Contenido.......");
                $.post("{{ url('AjaxBusquedas/ajaxPostEmpresa') }}",
                        params,
                        function (data) {
                            $("#contentEmpresa").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentEmpresa").html("No hay Resultados");
                })
            });
        });

        $(document).ready(function () {
            $("#listaAgencia").click(function (e) {
                e.preventDefault();
                var params = "busquedaAgencia=" + document.getElementById("labelBusquedaAgencia").value;
                $("#contentAgencia").html("Cargando Contenido.......");
                $.post("{{ url('AjaxBusquedas/ajaxPostAgencia') }}",
                        params,
                        function (data) {
                            $("#contentAgencia").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentAgencia").html("No hay Resultados");
                })
            });
        });

    </script>