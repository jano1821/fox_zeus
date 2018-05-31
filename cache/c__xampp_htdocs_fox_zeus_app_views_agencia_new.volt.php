<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['agencia', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-record'></i> Nueva Agencia</h4>
            </div>
            <div class="page-header">
            </div>

            <?= $this->getContent() ?>
            <?= $this->partial('ajax/findEmpresa') ?>
            <?= $this->tag->form(['agencia/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

            <div class="table">
                <?php if ($superAdmin == 'Z') { ?>
                    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
                            <label for="fieldCodmenu">Empresa</label>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <?= $form->render('nombreEmpresa') ?>
                                    <?= $form->render('codEmpresa') ?>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalEmpresas" id="listaEmpresa">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php } ?>

                <div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label for="fieldDescripcion">Descripcion</label>
                    </div>
                    <div class="col-md-3">
                        <?= $form->render('descripcion') ?>
                    </div>
                </div>

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