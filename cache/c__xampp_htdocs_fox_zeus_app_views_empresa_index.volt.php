<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
<?= $this->tag->linkTo(['menu', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver al Menu', 'class' => 'btn btn-info']) ?>
<?= $this->tag->linkTo(['empresa/new', '<i class=\'glyphicon glyphicon-plus\'></i> Nueva Empresa', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Empresas</h4>
            </div>
            <div class="page-header">
        </div>
<?= $this->getContent() ?>

<?= $this->tag->form(['empresa/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>


<div class="table">

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldNombreempresa" >NombreEmpresa</label>
</div>
                    <div class="col-md-3">
<?= $form->render('nombreEmpresa') ?>
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldRazonsocial">RazonSocial</label>
</div>
                    <div class="col-md-3">
<?= $form->render('razonSocial') ?>
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldLimiteusuarios">LimiteUsuarios</label>
</div>
                    <div class="col-md-3">
<?= $form->render('limiteUsuarios') ?>
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldIdentificadorempresa">IdentificadorEmpresa</label>
</div>
                    <div class="col-md-3">
        <?= $form->render('identificadorEmpresa') ?>
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
                        <?= $this->tag->linkTo(['empresa/reset', 'Limpiar', 'class' => 'btn btn-default']) ?>   
                        <?= $form->render('buscar') ?>
                        <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>