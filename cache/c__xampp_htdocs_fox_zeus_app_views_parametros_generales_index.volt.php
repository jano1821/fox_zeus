<div class="page-header">
    <h1>
        Search parametros_generales
    </h1>
    <p>
        <?= $this->tag->linkTo(['parametros_generales/new', 'Create parametros_generales']) ?>
    </p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['parametros_generales/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldCodparametro" class="col-sm-2 control-label">CodParametro</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codParametro', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodparametro']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldIdentificadorparametro" class="col-sm-2 control-label">IdentificadorParametro</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['identificadorParametro', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldIdentificadorparametro']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldValorparametro" class="col-sm-2 control-label">ValorParametro</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['valorParametro', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldValorparametro']) ?>
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
    <label for="fieldIndicadorfijo" class="col-sm-2 control-label">IndicadorFijo</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['indicadorFijo', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldIndicadorfijo']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['codEmpresa', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldCodempresa']) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
