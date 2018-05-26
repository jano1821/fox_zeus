<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <?= $this->tag->linkTo(['persona', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver a Personas', 'class' => 'btn btn-info']) ?>
                    <?= $this->tag->linkTo(['menu', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver al Menu', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Tipo Persona</h4>
            </div>
            <div class="page-header">
        </div>
<?= $this->getContent() ?>

<?= $this->tag->form(['tipo_persona/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>
<div class="table">
    <div class="form-group">
        <h3>
            <div class="col-md-4">
            </div>
            <div class="col-md-6">
                <div class="label label-success">
                    <label for="nombrePersona"><?= $nombrePersona ?></label>
                </div>
            </div>
        </h3>
    </div>

    <div class="form-group">
        <div class="col-md-3">
        </div>
        <div class="col-md-2">
            <label for="fieldDescripcion">Empleado</label>
        </div>
        <div class="col-md-3">
            <?= $form->render('empleado', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
        <label for="fieldEstadoregistro">Cliente</label>
    </div>
                        <div class="col-md-3">
            <?= $form->render('cliente', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-2">
        <label for="fieldEstadoregistro">Proveedor</label>
    </div>
                        <div class="col-md-3">
            <?= $form->render('proveedor', ['class' => 'form-control']) ?>
        </div>
    </div>

    <?= $this->tag->hiddenField(['codPersona']) ?>

    <div class="form-group">
        <div class="col-md-3">
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <?= $form->render('save') ?>
        </div>
    </div>
</div>
</form>
    </div>
</div>