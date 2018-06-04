<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("precio/index", "Go Back") }}</li>
            <li class="next">{{ link_to("precio/new", "Create ") }}</li>
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
                <th>CodPrecio</th>
            <th>Descripcion</th>
            <th>Monto</th>
            <th>CodEmpresa</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodAgencia</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for precio in page.items %}
            <tr>
                <td>{{ precio.codPrecio }}</td>
            <td>{{ precio.descripcion }}</td>
            <td>{{ precio.monto }}</td>
            <td>{{ precio.codEmpresa }}</td>
            <td>{{ precio.estadoRegistro }}</td>
            <td>{{ precio.usuarioInsercion }}</td>
            <td>{{ precio.fechaInsercion }}</td>
            <td>{{ precio.usuarioModificacion }}</td>
            <td>{{ precio.fechaModificacion }}</td>
            <td>{{ precio.codAgencia }}</td>

                <td>{{ link_to("precio/edit/"~precio.codPrecio, "Edit") }}</td>
                <td>{{ link_to("precio/delete/"~precio.codPrecio, "Delete") }}</td>
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
                <li>{{ link_to("precio/search", "First") }}</li>
                <li>{{ link_to("precio/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("precio/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("precio/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
