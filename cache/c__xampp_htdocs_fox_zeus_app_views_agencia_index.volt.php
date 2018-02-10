<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
<?= $this->tag->linkTo(['empresa', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver a Empresas', 'class' => 'btn btn-info']) ?>
<?= $this->tag->linkTo(['agencia/new', '<i class=\'glyphicon glyphicon-plus\'></i> Nueva Agencia', 'class' => 'btn btn-info']) ?>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Agencias</h4>
            </div>
            <div class="page-header">
        </div>
<?= $this->getContent() ?>

<?= $this->tag->form(['agencia/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="table">

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldDescripcion">Nombre Agencia</label>
</div>
                    <div class="col-md-3">
        <?= $this->tag->textField(['descripcion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldDescripcion']) ?>
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
                        <?= $this->tag->linkTo(['agencia/reset', 'Limpiar', 'class' => 'btn btn-default']) ?>   
                        <?= $form->render('buscar') ?>
                        <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>