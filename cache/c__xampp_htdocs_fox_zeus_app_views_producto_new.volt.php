<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['producto/index', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Productos</h4>
            </div>
            <div class="page-header">
            </div>
            <?= $this->getContent() ?>
            <?= $this->partial('ajax/findCategoria') ?>
            <?= $this->partial('ajax/findMarca') ?>
            <?= $this->partial('ajax/findModelo') ?>
            <?= $this->tag->form(['producto/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

            <div class="table">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion" >Descripcion</label>
                        </div>
                        <div class="col-xs-5">
                            <?= $form->render('descripcion') ?>
                            <?= $form->render('codProducto') ?>
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion" >Descripcion Corta</label>
                        </div>
                        <div class="col-xs-5">
                            <?= $form->render('descCorta') ?>
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>        

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion" >Imagen</label>
                        </div>
                        <div class="col-xs-5">
                            <?= $form->render('imagen') ?>
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>    

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion" >Fec. de Venc.</label>
                        </div>
                        <div class="col-xs-5">
                            <?= $form->render('fechaVencimiento') ?>
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>          

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Categoria</label>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->render('codCategoria') ?>
                            <?= $form->render('categoria') ?>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalCategoria" id="listaCategoria">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Marca</label>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->render('codMarca') ?>
                            <?= $form->render('marca') ?>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalMarca" id="listaMarca">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Modelo</label>
                        </div>
                        <div class="col-xs-4">
                            <?= $form->render('codModelo') ?>
                            <?= $form->render('modelo') ?>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalModelo" id="listaModelo">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-4">
                            <?= $form->render('save') ?>
                            <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                        </div>
                        <div class="col-xs-3">

                        </div>
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
        $('#listaCategoria').on("click", function (e) {
            e.preventDefault();
            var params = "busquedaCategoria=" + document.getElementById("labelBusquedaCategoria").value;
            $("#contentCategoria").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostCategoria') ?>",
                    params,
                    function (data) {
                        $("#contentCategoria").html(data.res.codigo);
                    }).fail(function () {
                $("#contentCategoria").html("No hay Resultados");
            })
        });
    });
    $(document).ready(function () {
        $('#listaMarca').on("click", function (e) {
            e.preventDefault();
            var params = "busquedaMarca=" + document.getElementById("labelBusquedaMarca").value;
            $("#contentMarca").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostMarca') ?>",
                    params,
                    function (data) {
                        $("#contentMarca").html(data.res.codigo);
                    }).fail(function () {
                $("#contentMarca").html("No hay Resultados");
            })
        });
    });

    $(document).ready(function () {
        $("#listaModelo").click(function (e) {
            e.preventDefault();
            var params = "busquedaModelo=" + document.getElementById("labelBusquedaModelo").value;
            $("#contentModelo").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('AjaxBusquedas/ajaxPostModelo') ?>",
                    params,
                    function (data) {
                        $("#contentModelo").html(data.res.codigo);
                    }).fail(function () {
                $("#contentModelo").html("No hay Resultados");
            })
        });
    });
</script>