<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("parametros_generales/index", "Go Back") }}</li>
            <li class="next">{{ link_to("parametros_generales/new", "Create ") }}</li>
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
                <th>CodParametro</th>
            <th>IdentificadorParametro</th>
            <th>ValorParametro</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>IndicadorFijo</th>
            <th>CodEmpresa</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for parametros_generale in page.items %}
            <tr>
                <td>{{ parametros_generale.codParametro }}</td>
            <td>{{ parametros_generale.identificadorParametro }}</td>
            <td>{{ parametros_generale.valorParametro }}</td>
            <td>{{ parametros_generale.estadoRegistro }}</td>
            <td>{{ parametros_generale.usuarioInsercion }}</td>
            <td>{{ parametros_generale.fechaInsercion }}</td>
            <td>{{ parametros_generale.usuarioModificacion }}</td>
            <td>{{ parametros_generale.fechaModificacion }}</td>
            <td>{{ parametros_generale.indicadorFijo }}</td>
            <td>{{ parametros_generale.codEmpresa }}</td>

                <td>{{ link_to("parametros_generales/edit/"~parametros_generale.codParametro, "Edit") }}</td>
                <td>{{ link_to("parametros_generales/delete/"~parametros_generale.codParametro, "Delete") }}</td>
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
                <li>{{ link_to("parametros_generales/search", "First") }}</li>
                <li>{{ link_to("parametros_generales/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("parametros_generales/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("parametros_generales/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
