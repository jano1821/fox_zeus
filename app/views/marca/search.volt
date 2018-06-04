<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("marca/index", "Go Back") }}</li>
            <li class="next">{{ link_to("marca/new", "Create ") }}</li>
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
                <th>CodMarca</th>
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
        {% for marca in page.items %}
            <tr>
                <td>{{ marca.codMarca }}</td>
            <td>{{ marca.descripcion }}</td>
            <td>{{ marca.estadoRegistro }}</td>
            <td>{{ marca.usuarioInsercion }}</td>
            <td>{{ marca.fechaInsercion }}</td>
            <td>{{ marca.usuarioModificacion }}</td>
            <td>{{ marca.fechaModificacion }}</td>
            <td>{{ marca.indicadorExclusivo }}</td>
            <td>{{ marca.codEmpresa }}</td>
            <td>{{ marca.codAgencia }}</td>

                <td>{{ link_to("marca/edit/"~marca.codMarca, "Edit") }}</td>
                <td>{{ link_to("marca/delete/"~marca.codMarca, "Delete") }}</td>
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
                <li>{{ link_to("marca/search", "First") }}</li>
                <li>{{ link_to("marca/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("marca/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("marca/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
