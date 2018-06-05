<div class="page-header">
    <h1>
        Search modelo
    </h1>
    <p>
        <?= $this->tag->linkTo(['modelo/new', 'Create modelo']) ?>
    </p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['modelo/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldCodmodelo" class="col-sm-2 control-label">CodModelo</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codModelo', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodmodelo']) ?>
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
    <label for="fieldIndicadorexclusivo" class="col-sm-2 control-label">IndicadorExclusivo</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['indicadorExclusivo', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldIndicadorexclusivo']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codEmpresa', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodempresa']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodagencia" class="col-sm-2 control-label">CodAgencia</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codAgencia', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodagencia']) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
