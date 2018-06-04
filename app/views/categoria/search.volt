<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("categoria/index", "Go Back") }}</li>
            <li class="next">{{ link_to("categoria/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CodCategoria</th>
            <th>Descripcion</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>IndicadorExclusivo</th>
            <th>CodEmpresa</th>
            <th>CodAgencia</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for categoria in page.items %}
            <tr>
                <td>{{ categoria.codCategoria }}</td>
            <td>{{ categoria.descripcion }}</td>
            <td>{{ categoria.estadoRegistro }}</td>
            <td>{{ categoria.usuarioInsercion }}</td>
            <td>{{ categoria.fechaInsercion }}</td>
            <td>{{ categoria.usuarioModificacion }}</td>
            <td>{{ categoria.fechaModificacion }}</td>
            <td>{{ categoria.indicadorExclusivo }}</td>
            <td>{{ categoria.codEmpresa }}</td>
            <td>{{ categoria.codAgencia }}</td>

                <td>{{ link_to("categoria/edit/"~categoria.codCategoria, "Edit") }}</td>
                <td>{{ link_to("categoria/delete/"~categoria.codCategoria, "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("categoria/search", "First") }}</li>
                <li>{{ link_to("categoria/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("categoria/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("categoria/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
