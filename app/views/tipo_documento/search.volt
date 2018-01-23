<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("tipo_documento/index", "Go Back") }}</li>
            <li class="next">{{ link_to("tipo_documento/new", "Create ") }}</li>
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
                <th>CodTipoDocumento</th>
            <th>Descripcion</th>
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
        {% for tipo_documento in page.items %}
            <tr>
                <td>{{ tipo_documento.codTipoDocumento }}</td>
            <td>{{ tipo_documento.descripcion }}</td>
            <td>{{ tipo_documento.estadoRegistro }}</td>
            <td>{{ tipo_documento.usuarioInsercion }}</td>
            <td>{{ tipo_documento.fechaInsercion }}</td>
            <td>{{ tipo_documento.usuarioModificacion }}</td>
            <td>{{ tipo_documento.fechaModificacion }}</td>

                <td>{{ link_to("tipo_documento/edit/"~tipo_documento.codTipoDocumento, "Edit") }}</td>
                <td>{{ link_to("tipo_documento/delete/"~tipo_documento.codTipoDocumento, "Delete") }}</td>
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
                <li>{{ link_to("tipo_documento/search", "First") }}</li>
                <li>{{ link_to("tipo_documento/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("tipo_documento/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("tipo_documento/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
