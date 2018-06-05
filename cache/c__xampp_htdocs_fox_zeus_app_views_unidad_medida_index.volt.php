<div class="page-header">
    <h1>
        Search unidad_medida
    </h1>
    <p>
        <?= $this->tag->linkTo(['unidad_medida/new', 'Create unidad_medida']) ?>
    </p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['unidad_medida/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldCodunidad" class="col-sm-2 control-label">CodUnidad</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codUnidad', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodunidad']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDescripcion" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['descripcion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldDescripcion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEstadoregistro" class="col-sm-2 control-label">EstadoRegistro</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['estadoRegistro', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldEstadoregistro']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldUsuarioinsercion" class="col-sm-2 control-label">UsuarioInsercion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['usuarioInsercion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldUsuarioinsercion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFechainsercion" class="col-sm-2 control-label">FechaInsercion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fechaInsercion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFechainsercion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldUsuariomodificacion" class="col-sm-2 control-label">UsuarioModificacion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['usuarioModificacion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldUsuariomodificacion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFechamodificacion" class="col-sm-2 control-label">FechaModificacion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fechaModificacion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFechamodificacion']) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
