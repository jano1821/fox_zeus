<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("menu_usuario/index", "Go Back") }}</li>
            <li class="next">{{ link_to("menu_usuario/new", "Create ") }}</li>
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
        {% for menu_usuario in page.items %}
            <tr>
                <td>{{ menu_usuario.codMenu }}</td>
            <td>{{ menu_usuario.codUsuario }}</td>
            <td>{{ menu_usuario.estadoRegistro }}</td>
            <td>{{ menu_usuario.usuarioInsercion }}</td>
            <td>{{ menu_usuario.fechaInsercion }}</td>
            <td>{{ menu_usuario.usuarioModificacion }}</td>
            <td>{{ menu_usuario.fechaModificacion }}</td>

                <td>{{ link_to("menu_usuario/edit/"~menu_usuario.codMenu, "Edit") }}</td>
                <td>{{ link_to("menu_usuario/delete/"~menu_usuario.codMenu, "Delete") }}</td>
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
                <li>{{ link_to("menu_usuario/search", "First") }}</li>
                <li>{{ link_to("menu_usuario/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("menu_usuario/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("menu_usuario/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
