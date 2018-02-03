<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
        <?= $this->tag->linkTo(['empresa', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver', 'class' => 'btn btn-info']) ?>
            </div>
<h4><i class='glyphicon glyphicon-edit'></i> Editar Empresa</h4>
</div>
<div class="page-header">
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['empresa/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="table">

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldNombreempresa" class="col-sm-2 control-label">NombreEmpresa</label>
</div>
    <div class="col-md-3">
<?= $form->render('nombreEmpresa') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldRazonsocial" class="col-sm-2 control-label">RazonSocial</label>
</div>
    <div class="col-md-3">
<?= $form->render('razonSocial') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldLimiteusuarios" class="col-sm-2 control-label">LimiteUsuarios</label>
</div>
    <div class="col-md-3">
<?= $form->render('limiteUsuarios') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldIdentificadorempresa" class="col-sm-2 control-label">IdentificadorEmpresa</label>
</div>
    <div class="col-md-3">
<?= $form->render('identificadorEmpresa') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldEstadoregistro" class="col-sm-2 control-label">EstadoRegistro</label>
</div>
    <div class="col-md-3">
<?= $form->render('estadoRegistro', ['class' => 'form-control']) ?>
    </div>
</div>

<?= $this->tag->hiddenField(['codEmpresa']) ?>

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