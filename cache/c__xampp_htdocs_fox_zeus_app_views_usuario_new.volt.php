<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
<?= $this->tag->linkTo(['usuario', '<i class=\'glyphicon glyphicon-chevron-left\'></i> Volver a Búsqueda', 'class' => 'btn btn-info']) ?>
        </div>
<h4><i class='glyphicon glyphicon-search'></i>Nuevo Usuario</h4>
</div>

<div class="page-header">
</div>

<?= $this->getContent() ?>

<?php require_once('files/datosSesion.php');?>

<?= $this->tag->form(['usuario/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="table">

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldCodPersonaUsuario" class="col-sm-2 control-label">Persona</label>
</div>
    <div class="col-md-3">
        <?php if (isset($personaUsuario)) { ?>
            <?= $this->tag->select(['codPersonaUsuario', $personaUsuario, 'useEmpty' => true, 'emptyText' => 'Seleccione Persona...', 'emptyValue' => '', 'using' => ['codPersonaUsuario', 'nombres'], 'class' => 'form-control']) ?>
        <?php } ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldCodempresa" class="col-sm-2 control-label">Empresa</label>
</div>
<div class="col-md-3">
    <?php if (isset($empresa)) { ?>
                            <?= $this->tag->select(['codEmpresa', $empresa, 'useEmpty' => true, 'emptyText' => 'Seleccione Empresa...', 'emptyValue' => '', 'using' => ['codEmpresa', 'nombreEmpresa'], 'class' => 'form-control']) ?>
                        <?php } ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldNombreusuario" class="col-sm-2 control-label">Usuario</label>
</div>
<div class="col-md-3">
        <?= $form->render('nombreUsuario') ?>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldPasswordusuario" class="col-sm-2 control-label">Password</label>
</div>
<div class="col-md-3">
<?= $form->render('passwordUsuario') ?>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
    </div>
    <div class="col-md-2">
        <label for="fieldIndicadorusuarioadministrador" class="col-sm-2 control-label">Administrador</label>
    </div>
    <div class="col-md-3">
        <?php
        if ($indicadorUsuarioAdministrador=='Z'){
        ?>
            <?= $this->tag->selectStatic(['indicadorUsuarioAdministrador', ['' => 'Selecciona Privilegios...', 'Z' => 'Super Administrador', 'S' => 'Administrador', 'N' => 'No Administrador'], 'class' => 'form-control']) ?>
        <?php
        }else{
        ?>
            <?= $this->tag->selectStatic(['indicadorUsuarioAdministrador', ['' => 'Selecciona Privilegios...', 'S' => 'Administrador', 'N' => 'No Administrador'], 'class' => 'form-control']) ?>
        <?php
        }
        ?>
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