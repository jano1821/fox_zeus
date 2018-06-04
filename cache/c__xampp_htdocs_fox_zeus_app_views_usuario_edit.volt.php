<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['usuario', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver', 'class' => 'btn btn-info']) ?>
                    <?= $this->tag->linkTo(['menu_sistema', '<i class=\'glyphicon glyphicon-ice-lolly\'></i> Vincular Sistema', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-edit'></i> Editar Usuario</h4>
            </div>
            <div class="page-header">
            </div>

            <?= $this->getContent() ?>
            <?= $this->partial('index/teclado') ?>
            <?= $this->partial('ajax/findEmpresa') ?>
            <?= $this->tag->form(['usuario/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

            <div class="table">
                <?php if ($superAdmin == 'Z') { ?>
                    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <label for="fieldCodempresa" class="control-label">Empresa</label>
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
                        <label for="fieldNombreusuario" >Usuario</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('nombreUsuario') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldPasswordusuario" >Password</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('password') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCantidadintentos" >Intentos</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('cantidadIntentos') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldIndicadorusuarioadministrador" >Administrador</label>
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
                        <label for="fieldEstadoregistro" c>Estado de Registro</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('estadoRegistro', ['class' => 'form-control']) ?>
                    </div>
                </div>

                <?= $this->tag->hiddenField(['codUsuario']) ?>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        <?= $form->render('save') ?>
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
            $('#listaPersona').on("click", function (e) {
                e.preventDefault();
                var params = "busquedaPersona=" + document.getElementById("labelBusquedaPersona").value;
                params += "&codEmpresa=" + document.getElementById("codEmpresa").value;
                $("#contentPersona").html("Cargando Contenido.......");
                $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostPersona') ?>",
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
                $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostEmpresa') ?>",
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
                params += "&codEmpresa=" + document.getElementById("codEmpresa").value;
                $("#contentAgencia").html("Cargando Contenido.......");
                $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostAgencia') ?>",
                        params,
                        function (data) {
                            $("#contentAgencia").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentAgencia").html("No hay Resultados");
                })
            });
        });

        $(document).ready(function () {
            $('#teclado').on("click", function (e) {
                e.preventDefault();

            });
        });
    </script>