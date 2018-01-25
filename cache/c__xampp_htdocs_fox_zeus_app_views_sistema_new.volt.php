<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
<?= $this->tag->linkTo(['sistema', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver a Búsqueda', 'class' => 'btn btn-info']) ?>
        </div>
<h4><i class='glyphicon glyphicon-record'></i>Nuevo Sistema</h4>
</div>

<div class="page-header">
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['sistema/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="table">

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldEtiquetasistema">Etiqueta del Sistema</label>
</div>
    <div class="col-md-3">
<?= $form->render('etiquetaSistema') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldUrlsistema">Url Sistema</label>
</div>
    <div class="col-md-3">
<?= $form->render('urlSistema') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldUrlicono">Url Icono</label>
</div>
    <div class="col-md-3">
<?= $form->render('urlIcono') ?>
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldIndicador">Indicador Admin</label>
</div>
                    <div class="col-md-3">
        <?= $form->render('indicadorAdministrador', ['class' => 'form-control']) ?>
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
