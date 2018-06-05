<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['producto', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create producto
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['producto/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldDescripcion" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['descripcion', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldDescripcion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldImagen" class="col-sm-2 control-label">Imagen</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['imagen', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldImagen']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFechabaja" class="col-sm-2 control-label">FechaBaja</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fechaBaja', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFechabaja']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldMotivobaja" class="col-sm-2 control-label">MotivoBaja</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['motivoBaja', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldMotivobaja']) ?>
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
    <label for="fieldCodcategoria" class="col-sm-2 control-label">CodCategoria</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codCategoria', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodcategoria']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodmarca" class="col-sm-2 control-label">CodMarca</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codMarca', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodmarca']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodmodelo" class="col-sm-2 control-label">CodModelo</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codModelo', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodmodelo']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codEmpresa', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodempresa']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDescripcioncorta" class="col-sm-2 control-label">DescripcionCorta</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['descripcionCorta', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldDescripcioncorta']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFechavencimiento" class="col-sm-2 control-label">FechaVencimiento</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fechaVencimiento', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFechavencimiento']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFechaalta" class="col-sm-2 control-label">FechaAlta</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fechaAlta', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFechaalta']) ?>
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
        <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
