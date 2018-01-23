<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("empresa/index", "Go Back") }}</li>
            <li class="next">{{ link_to("empresa/new", "Create ") }}</li>
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
                <th>CodEmpresa</th>
            <th>NombreEmpresa</th>
            <th>RazonSocial</th>
            <th>LimiteUsuarios</th>
            <th>IdentificadorEmpresa</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for empresa in page.items %}
            <tr>
                <td>{{ empresa.codEmpresa }}</td>
            <td>{{ empresa.nombreEmpresa }}</td>
            <td>{{ empresa.razonSocial }}</td>
            <td>{{ empresa.limiteUsuarios }}</td>
            <td>{{ empresa.identificadorEmpresa }}</td>
            <td>{{ empresa.estadoRegistro }}</td>
            <td>{{ empresa.usuarioInsercion }}</td>
            <td>{{ empresa.fechaInsercion }}</td>
            <td>{{ empresa.usuarioModificacion }}</td>
            <td>{{ empresa.fechaModificacion }}</td>

                <td>{{ link_to("empresa/edit/"~empresa.codEmpresa, "Edit") }}</td>
                <td>{{ link_to("empresa/delete/"~empresa.codEmpresa, "Delete") }}</td>
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
                <li>{{ link_to("empresa/search", "First") }}</li>
                <li>{{ link_to("empresa/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("empresa/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("empresa/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
