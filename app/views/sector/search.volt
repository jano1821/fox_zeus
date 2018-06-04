<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("sector/index", "Go Back") }}</li>
            <li class="next">{{ link_to("sector/new", "Create ") }}</li>
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
                <th>CodSector</th>
            <th>Descripcion</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodEmpresa</th>
            <th>CodAgencia</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for sector in page.items %}
            <tr>
                <td>{{ sector.codSector }}</td>
            <td>{{ sector.descripcion }}</td>
            <td>{{ sector.estadoRegistro }}</td>
            <td>{{ sector.usuarioInsercion }}</td>
            <td>{{ sector.fechaInsercion }}</td>
            <td>{{ sector.usuarioModificacion }}</td>
            <td>{{ sector.fechaModificacion }}</td>
            <td>{{ sector.codEmpresa }}</td>
            <td>{{ sector.codAgencia }}</td>

                <td>{{ link_to("sector/edit/"~sector.codSector, "Edit") }}</td>
                <td>{{ link_to("sector/delete/"~sector.codSector, "Delete") }}</td>
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
                <li>{{ link_to("sector/search", "First") }}</li>
                <li>{{ link_to("sector/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("sector/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("sector/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
