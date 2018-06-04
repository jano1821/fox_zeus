<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("modelo/index", "Go Back") }}</li>
            <li class="next">{{ link_to("modelo/new", "Create ") }}</li>
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
                <th>CodModelo</th>
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
        {% for modelo in page.items %}
            <tr>
                <td>{{ modelo.codModelo }}</td>
            <td>{{ modelo.descripcion }}</td>
            <td>{{ modelo.estadoRegistro }}</td>
            <td>{{ modelo.usuarioInsercion }}</td>
            <td>{{ modelo.fechaInsercion }}</td>
            <td>{{ modelo.usuarioModificacion }}</td>
            <td>{{ modelo.fechaModificacion }}</td>
            <td>{{ modelo.indicadorExclusivo }}</td>
            <td>{{ modelo.codEmpresa }}</td>
            <td>{{ modelo.codAgencia }}</td>

                <td>{{ link_to("modelo/edit/"~modelo.codModelo, "Edit") }}</td>
                <td>{{ link_to("modelo/delete/"~modelo.codModelo, "Delete") }}</td>
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
                <li>{{ link_to("modelo/search", "First") }}</li>
                <li>{{ link_to("modelo/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("modelo/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("modelo/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
