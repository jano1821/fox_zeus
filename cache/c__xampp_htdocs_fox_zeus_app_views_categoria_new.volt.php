<?= $this->getContent() ?>
<?= $this->partial('inventory/title') ?>
<?= $this->partial('inventory/head') ?>
<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?= $this->tag->linkTo(['categoria/index', '<i class=\'glyphicon glyphicon-search\'></i> Buscar Categoria', 'class' => 'btn btn-info']) ?>
            </div>
            <div class="page-header">
            </div>
            <?= $this->tag->form(['categoria/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

            <div class="table">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion">Descripcion</label>
                        </div>
                        <div class="col-xs-5">
                            <?= $form->render('descripcion') ?>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-4">
                            <?= $form->render('save') ?>
                            <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                        </div>
                        <div class="col-xs-3">

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
