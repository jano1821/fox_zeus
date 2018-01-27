<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
<?= $this->tag->linkTo(['menu', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver al Menu', 'class' => 'btn btn-info']) ?>
<?= $this->tag->linkTo(['usuario', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver Busqueda de Usuario', 'class' => 'btn btn-info']) ?>
    <?= $this->tag->linkTo(['menu_sistema/new', '<i class=\'glyphicon glyphicon-plus\'></i> Nuevo Vinculo', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Vinculos Menu Sistemas</h4>
            </div>
            <div class="page-header">
        </div>

<?= $this->getContent() ?>
<?= $this->partial('ajax/findMenu') ?>
<?= $this->partial('ajax/findSistema') ?>
<?= $this->partial('ajax/findUsuario') ?>
<?= $this->tag->form(['menu_sistema/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="table">

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldCodmenu">Menu</label>
</div>
                    <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <?= $form->render('nombreMenu') ?>
                            <?= $form->render('codMenu') ?>
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
    <label for="fieldCodusuario">Usuario</label>
</div>
                    <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <?= $form->render('nombreUsuario') ?>
                            <?= $form->render('codUsuario') ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="listaUsuarios">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#listaMenu').on("click",function(e){
            e.preventDefault();
            var params = "busquedaMenu="+document.getElementById("labelBusquedaMenu").value;
            $("#contentMenu").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('menu_sistema/ajaxPostMenu') ?>", 
                    params, 
                    function(data) {
                        $("#contentMenu").html(data.res.codigo);
                    }).fail(function() {
                        $("#contentMenu").html("No hay Resultados");
                    })
        });
    });

    $(document).ready(function() {
        $('#listaUsuarios').on("click",function(e){
            e.preventDefault();
            var params = "busquedaUsuario="+document.getElementById("labelBusquedaUsuario").value;
            $("#content").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('menu_sistema/ajaxPostUsuario') ?>", 
                    params, 
                    function(data) {
                        $("#content").html(data.res.codigo);
                    }).fail(function() {
                        $("#content").html("No hay Resultados");
                    })
        });
    });

    $(document).ready(function(){
        $("#listaSistemas").click(function(e){
            e.preventDefault();
            var params = "busquedaSistema="+document.getElementById("labelBusquedaSistema").value;
            $("#contentSistema").html("Cargando Contenido.......");
            $.post("<?= $this->url->get('menu_sistema/ajaxPostSistema') ?>", 
                    params, 
                    function(data) {
                        $("#contentSistema").html(data.res.codigo);
                    }).fail(function() {
                        $("#contentSistema").html("No hay Resultados");
                    })
        });
    });

    
</script>