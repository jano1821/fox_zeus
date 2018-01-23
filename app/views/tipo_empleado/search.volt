<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("tipo_empleado/index", "Go Back") }}</li>
            <li class="next">{{ link_to("tipo_empleado/new", "Create ") }}</li>
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
                <th>CodTipoEmpleado</th>
            <th>Descripcion</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodEmpresa</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for tipo_empleado in page.items %}
            <tr>
                <td>{{ tipo_empleado.codTipoEmpleado }}</td>
            <td>{{ tipo_empleado.descripcion }}</td>
            <td>{{ tipo_empleado.estadoRegistro }}</td>
            <td>{{ tipo_empleado.usuarioInsercion }}</td>
            <td>{{ tipo_empleado.fechaInsercion }}</td>
            <td>{{ tipo_empleado.usuarioModificacion }}</td>
            <td>{{ tipo_empleado.fechaModificacion }}</td>
            <td>{{ tipo_empleado.codEmpresa }}</td>

                <td>{{ link_to("tipo_empleado/edit/"~tipo_empleado.codTipoEmpleado, "Edit") }}</td>
                <td>{{ link_to("tipo_empleado/delete/"~tipo_empleado.codTipoEmpleado, "Delete") }}</td>
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
                <li>{{ link_to("tipo_empleado/search", "First") }}</li>
                <li>{{ link_to("tipo_empleado/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("tipo_empleado/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("tipo_empleado/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
