<?= $this->getContent() ?>
<?= $this->partial('inventory/title') ?>
<?= $this->partial('inventory/head') ?>
<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?= $this->tag->linkTo(['categoria/new', '<i class=\'glyphicon glyphicon-plus\'></i> Nueva Categoria', 'class' => 'btn btn-info']) ?>
                <?= $this->tag->linkTo(['categoria/index', '<i class=\'glyphicon glyphicon-search\'></i> Buscar Categoria', 'class' => 'btn btn-info']) ?>
            </div>


            <?= $this->tag->form(['sistema/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>
            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Descripcion</th>
                        <th>Estado</th>

                        <th></th>
                        <th></th>
                    </tr>
                    <tbody>
                        <?php if (isset($page->items)) { ?>
                            <?php foreach ($page->items as $categoria) { ?>
                                <tr>
                                    <td><?= $categoria->descripcion ?></td>
                                    <td><?= $categoria->estado ?></td>

                                    <td><?= $this->tag->linkTo(['categoria/edit/' . $categoria->codCategoria, 'class' => 'btn btn-default', '<i class=\'glyphicon glyphicon-edit\'></i>']) ?></td>
                                    <td><?= $this->tag->linkTo(['categoria/delete/' . $categoria->codCategoria, 'class' => 'btn btn-default', '<i class=\'glyphicon glyphicon-trash\'></i>']) ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?= $this->tag->hiddenField(['pagina']) ?>
            <?= $this->tag->hiddenField(['avance']) ?>

            <div class="row">
                <div class="col-sm-2">
                    <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                        <?= 'Página ' . $page->current . ' de ' . $page->total_pages ?>
                    </p>
                </div>
                <div class="col-sm-10">
                    <nav>
                        <ul class="pagination">
                            <?= $this->tag->submitButton(['Primero', 'class' => 'btn btn-info', 'onclick' => 'paginacion(0);']) ?>
                            <?= $this->tag->submitButton(['Anterior', 'class' => 'btn btn-info', 'onclick' => 'paginacion(-1);']) ?>
                            <?= $this->tag->submitButton(['Siguiente', 'class' => 'btn btn-info', 'onclick' => 'paginacion(1);']) ?>
                            <?= $this->tag->submitButton(['Ultimo', 'class' => 'btn btn-info', 'onclick' => 'paginacion(2);']) ?>
                        </ul>
                    </nav>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function paginacion(valor) {
        document.getElementById('avance').value = valor;
    }
</script>