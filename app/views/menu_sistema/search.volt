<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("menu_sistema/index", "Go Back") }}</li>
            <li class="next">{{ link_to("menu_sistema/new", "Create ") }}</li>
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
                <th>CodMenu</th>
            <th>CodSistema</th>
            <th>CodUsuario</th>
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
        {% for menu_sistema in page.items %}
            <tr>
                <td>{{ menu_sistema.codMenu }}</td>
            <td>{{ menu_sistema.codSistema }}</td>
            <td>{{ menu_sistema.codUsuario }}</td>
            <td>{{ menu_sistema.estadoRegistro }}</td>
            <td>{{ menu_sistema.usuarioInsercion }}</td>
            <td>{{ menu_sistema.fechaInsercion }}</td>
            <td>{{ menu_sistema.usuarioModificacion }}</td>
            <td>{{ menu_sistema.fechaModificacion }}</td>

                <td>{{ link_to("menu_sistema/edit/"~menu_sistema.codMenu, "Edit") }}</td>
                <td>{{ link_to("menu_sistema/delete/"~menu_sistema.codMenu, "Delete") }}</td>
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
                <li>{{ link_to("menu_sistema/search", "First") }}</li>
                <li>{{ link_to("menu_sistema/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("menu_sistema/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("menu_sistema/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
