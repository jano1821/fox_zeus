<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['menu', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver al Menu', 'class' => 'btn btn-info']) ?>
                    <?= $this->tag->linkTo(['empresa', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver a Busqueda de Empresa', 'class' => 'btn btn-info']) ?>
                    <?= $this->tag->linkTo(['empresa_sistema/new/' . $codigoEmpresa, '<i class=\'glyphicon glyphicon-plus\'></i> Nuevo Vinculo', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda Empresa Sistema</h4>
            </div>
            <div class="page-header">
            </div>
            <?= $this->getContent() ?>
            <?= $this->partial('ajax/findSistema') ?>
            <?= $this->tag->form(['empresa_sistema/search/' . $codigoEmpresa, 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>
            <div class="table">
                <div class="form-group">
                    <h3>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <?= $form->render('codEmpresa') ?>
                        </div>
                        <div class="col-md-6">
                            <div class="label label-success">
                                <label for="usuario"><?= $nombreEmpresa ?></label>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldCodsistema">Sistema</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                <?= $form->render('nombreSistema') ?>
                                <?= $form->render('codSistema') ?>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalSistema" id="listaSistemas">
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
                        <label for="fieldEstadoregistro">EstadoRegistro</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('estadoRegistro', ['class' => 'form-control']) ?>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        <?= $this->tag->linkTo(['menu_sistema/reset', 'Limpiar', 'class' => 'btn btn-default']) ?>   
                        <?= $form->render('buscar') ?>
                        <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>                  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#listaSistemas").click(function (e) {
                e.preventDefault();
                var params = "busquedaSistema=" + document.getElementById("labelBusquedaSistema").value;
                $("#contentSistema").html("Cargando Contenido.......");
                $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostSistemaTotal') ?>",
                        params,
                        function (data) {
                            $("#contentSistema").html(data.res.codigo);
                        }).fail(function () {
                    $("#contentSistema").html("No hay Resultados");
                })
            });
        });


    </script>