<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['parametros_generales/index', 'Go Back']) ?></li>
            <li class="next"><?= $this->tag->linkTo(['parametros_generales/new', 'Create ']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?= $this->getContent() ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CodParametro</th>
            <th>IdentificadorParametro</th>
            <th>ValorParametro</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>IndicadorFijo</th>
            <th>CodEmpresa</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $parametros_generale) { ?>
            <tr>
                <td><?= $parametros_generale->codParametro ?></td>
            <td><?= $parametros_generale->identificadorParametro ?></td>
            <td><?= $parametros_generale->valorParametro ?></td>
            <td><?= $parametros_generale->estadoRegistro ?></td>
            <td><?= $parametros_generale->usuarioInsercion ?></td>
            <td><?= $parametros_generale->fechaInsercion ?></td>
            <td><?= $parametros_generale->usuarioModificacion ?></td>
            <td><?= $parametros_generale->fechaModificacion ?></td>
            <td><?= $parametros_generale->indicadorFijo ?></td>
            <td><?= $parametros_generale->codEmpresa ?></td>

                <td><?= $this->tag->linkTo(['parametros_generales/edit/' . $parametros_generale->codParametro, 'Edit']) ?></td>
                <td><?= $this->tag->linkTo(['parametros_generales/delete/' . $parametros_generale->codParametro, 'Delete']) ?></td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?= $page->current . '/' . $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?= $this->tag->linkTo(['parametros_generales/search', 'First']) ?></li>
                <li><?= $this->tag->linkTo(['parametros_generales/search?page=' . $page->before, 'Previous']) ?></li>
                <li><?= $this->tag->linkTo(['parametros_generales/search?page=' . $page->next, 'Next']) ?></li>
                <li><?= $this->tag->linkTo(['parametros_generales/search?page=' . $page->last, 'Last']) ?></li>
            </ul>
        </nav>
    </div>
</div>
