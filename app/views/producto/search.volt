<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("producto/index", "Go Back") }}</li>
            <li class="next">{{ link_to("producto/new", "Create ") }}</li>
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
                <th>CodProducto</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>FechaBaja</th>
            <th>MotivoBaja</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodCategoria</th>
            <th>CodMarca</th>
            <th>CodModelo</th>
            <th>CodEmpresa</th>
            <th>DescripcionCorta</th>
            <th>FechaVencimiento</th>
            <th>FechaAlta</th>
            <th>CodAgencia</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for producto in page.items %}
            <tr>
                <td>{{ producto.codProducto }}</td>
            <td>{{ producto.descripcion }}</td>
            <td>{{ producto.imagen }}</td>
            <td>{{ producto.fechaBaja }}</td>
            <td>{{ producto.motivoBaja }}</td>
            <td>{{ producto.estadoRegistro }}</td>
            <td>{{ producto.usuarioInsercion }}</td>
            <td>{{ producto.fechaInsercion }}</td>
            <td>{{ producto.usuarioModificacion }}</td>
            <td>{{ producto.fechaModificacion }}</td>
            <td>{{ producto.codCategoria }}</td>
            <td>{{ producto.codMarca }}</td>
            <td>{{ producto.codModelo }}</td>
            <td>{{ producto.codEmpresa }}</td>
            <td>{{ producto.descripcionCorta }}</td>
            <td>{{ producto.fechaVencimiento }}</td>
            <td>{{ producto.fechaAlta }}</td>
            <td>{{ producto.codAgencia }}</td>

                <td>{{ link_to("producto/edit/"~producto.codProducto, "Edit") }}</td>
                <td>{{ link_to("producto/delete/"~producto.codProducto, "Delete") }}</td>
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
                <li>{{ link_to("producto/search", "First") }}</li>
                <li>{{ link_to("producto/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("producto/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("producto/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
