<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("unidad_medida/index", "Go Back") }}</li>
            <li class="next">{{ link_to("unidad_medida/new", "Create ") }}</li>
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
                <th>CodUnidad</th>
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
        {% for unidad_medida in page.items %}
            <tr>
                <td>{{ unidad_medida.codUnidad }}</td>
            <td>{{ unidad_medida.descripcion }}</td>
            <td>{{ unidad_medida.estadoRegistro }}</td>
            <td>{{ unidad_medida.usuarioInsercion }}</td>
            <td>{{ unidad_medida.fechaInsercion }}</td>
            <td>{{ unidad_medida.usuarioModificacion }}</td>
            <td>{{ unidad_medida.fechaModificacion }}</td>

                <td>{{ link_to("unidad_medida/edit/"~unidad_medida.codUnidad, "Edit") }}</td>
                <td>{{ link_to("unidad_medida/delete/"~unidad_medida.codUnidad, "Delete") }}</td>
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
                <li>{{ link_to("unidad_medida/search", "First") }}</li>
                <li>{{ link_to("unidad_medida/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("unidad_medida/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("unidad_medida/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
