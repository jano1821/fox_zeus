<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("usuario", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
                    {{ link_to("menu_sistema", "<i class='glyphicon glyphicon-ice-lolly'></i> Vincular Sistema","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-edit'></i> Editar Usuario</h4>
            </div>
            <div class="page-header">
            </div>

            {{ content() }}
            <?php require_once('files/datosSesion.php');?>
            {{ form("usuario/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

            <div class="table">
                {% if superAdmin == "Z" %}
                    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <label for="fieldCodempresa" >Empresa</label>
                        </div>
                        <div class="col-md-3">
                            {% if empresa is defined %}
                                {{ select("codEmpresa", empresa,'useEmpty': true, 'emptyText': 'Seleccione Empresa...', 'emptyValue': '', 'using': ['codEmpresa', 'nombreEmpresa'], "class" : "form-control") }}
                            {% endif %}
                        </div>
                    </div>
                {% endif %}
                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldNombreusuario" >Usuario</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('nombreUsuario') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldPasswordusuario" >Password</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('passwordUsuario') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCantidadintentos" >Intentos</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('cantidadIntentos') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldIndicadorusuarioadministrador" >Administrador</label>
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
                        <label for="fieldEstadoregistro" c>Estado de Registro</label>
                    </div>
                    <div class="col-md-3">
                        {{ form.render('estadoRegistro',['class' : 'form-control']) }}
                    </div>
                </div>

                {{ hidden_field("codUsuario") }}

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