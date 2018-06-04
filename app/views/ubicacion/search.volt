<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("ubicacion/index", "Go Back") }}</li>
            <li class="next">{{ link_to("ubicacion/new", "Create ") }}</li>
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
                <th>CodUbicacion</th>
            <th>CodSecion</th>
            <th>CodZona</th>
            <th>CodSector</th>
            <th>CodAlmacen</th>
            <th>CodEmpresa</th>
            <th>CodProducto</th>
            <th>CodAgencia</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for ubicacion in page.items %}
            <tr>
                <td>{{ ubicacion.codUbicacion }}</td>
            <td>{{ ubicacion.codSecion }}</td>
            <td>{{ ubicacion.codZona }}</td>
            <td>{{ ubicacion.codSector }}</td>
            <td>{{ ubicacion.codAlmacen }}</td>
            <td>{{ ubicacion.codEmpresa }}</td>
            <td>{{ ubicacion.codProducto }}</td>
            <td>{{ ubicacion.codAgencia }}</td>

                <td>{{ link_to("ubicacion/edit/"~ubicacion.codUbicacion, "Edit") }}</td>
                <td>{{ link_to("ubicacion/delete/"~ubicacion.codUbicacion, "Delete") }}</td>
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
                <li>{{ link_to("ubicacion/search", "First") }}</li>
                <li>{{ link_to("ubicacion/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("ubicacion/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("ubicacion/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
