<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("almacen/index", "Go Back") }}</li>
            <li class="next">{{ link_to("almacen/new", "Create ") }}</li>
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
                <th>CodAlmacen</th>
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
        {% for almacen in page.items %}
            <tr>
                <td>{{ almacen.codAlmacen }}</td>
            <td>{{ almacen.descripcion }}</td>
            <td>{{ almacen.estadoRegistro }}</td>
            <td>{{ almacen.usuarioInsercion }}</td>
            <td>{{ almacen.fechaInsercion }}</td>
            <td>{{ almacen.usuarioModificacion }}</td>
            <td>{{ almacen.fechaModificacion }}</td>
            <td>{{ almacen.codEmpresa }}</td>
            <td>{{ almacen.codAgencia }}</td>

                <td>{{ link_to("almacen/edit/"~almacen.codAlmacen, "Edit") }}</td>
                <td>{{ link_to("almacen/delete/"~almacen.codAlmacen, "Delete") }}</td>
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
                <li>{{ link_to("almacen/search", "First") }}</li>
                <li>{{ link_to("almacen/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("almacen/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("almacen/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
