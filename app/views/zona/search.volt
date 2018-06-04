<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("zona/index", "Go Back") }}</li>
            <li class="next">{{ link_to("zona/new", "Create ") }}</li>
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
                <th>CodZona</th>
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
        {% for zona in page.items %}
            <tr>
                <td>{{ zona.codZona }}</td>
            <td>{{ zona.descripcion }}</td>
            <td>{{ zona.estadoRegistro }}</td>
            <td>{{ zona.usuarioInsercion }}</td>
            <td>{{ zona.fechaInsercion }}</td>
            <td>{{ zona.usuarioModificacion }}</td>
            <td>{{ zona.fechaModificacion }}</td>
            <td>{{ zona.codEmpresa }}</td>
            <td>{{ zona.codAgencia }}</td>

                <td>{{ link_to("zona/edit/"~zona.codZona, "Edit") }}</td>
                <td>{{ link_to("zona/delete/"~zona.codZona, "Delete") }}</td>
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
                <li>{{ link_to("zona/search", "First") }}</li>
                <li>{{ link_to("zona/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("zona/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("zona/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
