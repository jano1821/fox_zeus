<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 */
?>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["empresa_sistema", "Back"]) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit empresa_sistema
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php
    echo $this->tag->form(
        [
            "empresa_sistema/save",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["codEmpresa", "type" => "number", "class" => "form-control", "id" => "fieldCodempresa"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCodsistema" class="col-sm-2 control-label">CodSistema</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["codSistema", "type" => "number", "class" => "form-control", "id" => "fieldCodsistema"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEstadoregistro" class="col-sm-2 control-label">EstadoRegistro</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["estadoRegistro", "size" => 30, "class" => "form-control", "id" => "fieldEstadoregistro"]) ?>
    </div>
</div>


<?php echo $this->tag->hiddenField("id") ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Save", "class" => "btn btn-default"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>
