<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("seccion/index", "Go Back") }}</li>
            <li class="next">{{ link_to("seccion/new", "Create ") }}</li>
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
                <th>CodSecion</th>
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
        {% for seccion in page.items %}
            <tr>
                <td>{{ seccion.codSecion }}</td>
            <td>{{ seccion.descripcion }}</td>
            <td>{{ seccion.estadoRegistro }}</td>
            <td>{{ seccion.usuarioInsercion }}</td>
            <td>{{ seccion.fechaInsercion }}</td>
            <td>{{ seccion.usuarioModificacion }}</td>
            <td>{{ seccion.fechaModificacion }}</td>
            <td>{{ seccion.codEmpresa }}</td>
            <td>{{ seccion.codAgencia }}</td>

                <td>{{ link_to("seccion/edit/"~seccion.codSecion, "Edit") }}</td>
                <td>{{ link_to("seccion/delete/"~seccion.codSecion, "Delete") }}</td>
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
                <li>{{ link_to("seccion/search", "First") }}</li>
                <li>{{ link_to("seccion/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("seccion/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("seccion/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
