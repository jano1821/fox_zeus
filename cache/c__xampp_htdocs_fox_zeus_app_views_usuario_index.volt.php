<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['menu', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver al Menu', 'class' => 'btn btn-info']) ?>
                    <?= $this->tag->linkTo(['usuario/new', '<i class=\'glyphicon glyphicon-user\'></i> Nuevo Usuario', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Usuarios</h4>
            </div>
            <div class="page-header">
            </div>

            <?= $this->getContent() ?>
            <?= $this->partial('ajax/findEmpresa') ?>
            <?= $this->tag->form(['usuario/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>
            <div class="table">
                <?php if ($superAdmin == 'Z') { ?>
                    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <label for="fieldCodempresa" control-label">Empresa</label>
                        </div>
                        <div class="col-md-4">
                            <?= $form->render('codEmpresa') ?>
                            <?= $form->render('nombreEmpresa') ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalEmpresas" id="listaEmpresa">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldNombreusuario">Nombre de Usuario</label>
                    </div>
                    <div class="col-md-2">
                        <?= $form->render('nombreUsuario') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCantidadintentos">Cantidad Intentos</label>
                    </div>
                    <div class="col-md-2">
                        <?= $form->render('cantidadIntentos') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldIndicadorusuarioadministrador">Usuario Administrador</label>
                    </div>
                    <div class="col-md-3">
                        <?php if ($superAdmin == 'Z') { ?>
                            <?= $this->tag->selectStatic(['indicadorUsuarioAdministrador', ['' => 'Selecciona Privilegios...', 'Z' => 'Super Administrador', 'S' => 'Administrador', 'N' => 'No Administrador'], 'class' => 'form-control']) ?>
                        <?php } else { ?>
                            <?= $this->tag->selectStatic(['indicadorUsuarioAdministrador', ['' => 'Selecciona Privilegios...', 'S' => 'Administrador', 'N' => 'No Administrador'], 'class' => 'form-control']) ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldEstadoregistro">Estado de Registro</label>
                    </div>
                    <div class="col-md-3">
                        <?= $this->tag->selectStatic(['estadoRegistro', ['' => 'Seleccione Estado...', 'S' => 'Vigente', 'N' => 'No Vigente'], 'class' => 'form-control']) ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        <?= $this->tag->linkTo(['usuario/reset', 'Limpiar', 'class' => 'btn btn-default']) ?>   
                        <?= $form->render('buscar') ?>
                        <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#listaEmpresa').on("click", function (e) {
                e.preventDefault();
                var params = "busquedaEmpresa=" + document.getElementById("labelBusquedaEmpresa").value;
                $("#contentEmpresa").html("Cargando Contenido.......");
                $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostEmpresa') ?>",
                        params,
                        function (data) {
                            $("#contentEmpresa").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentEmpresa").html("No hay Resultados");
                })
            });
        });
    </script>