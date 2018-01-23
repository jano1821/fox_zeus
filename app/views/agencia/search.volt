<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("agencia/index", "Go Back") }}</li>
            <li class="next">{{ link_to("agencia/new", "Create ") }}</li>
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
                <th>CodAgencia</th>
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
        {% for agencia in page.items %}
            <tr>
                <td>{{ agencia.codAgencia }}</td>
            <td>{{ agencia.descripcion }}</td>
            <td>{{ agencia.estadoRegistro }}</td>
            <td>{{ agencia.usuarioInsercion }}</td>
            <td>{{ agencia.fechaInsercion }}</td>
            <td>{{ agencia.usuarioModificacion }}</td>
            <td>{{ agencia.fechaModificacion }}</td>
            <td>{{ agencia.codEmpresa }}</td>

                <td>{{ link_to("agencia/edit/"~agencia.codAgencia, "Edit") }}</td>
                <td>{{ link_to("agencia/delete/"~agencia.codAgencia, "Delete") }}</td>
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
                <li>{{ link_to("agencia/search", "First") }}</li>
                <li>{{ link_to("agencia/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("agencia/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("agencia/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
