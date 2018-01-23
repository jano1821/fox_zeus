<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("persona/index", "Go Back") }}</li>
            <li class="next">{{ link_to("persona/new", "Create ") }}</li>
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
                <th>CodPersona</th>
            <th>NombrePersona</th>
            <th>ApePat</th>
            <th>ApeMat</th>
            <th>Sexo</th>
            <th>Edad</th>
            <th>NumeroDocumento</th>
            <th>RazonSocial</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodTipoDocumento</th>
            <th>TipoPersona</th>
            <th>CodEmpresa</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for persona in page.items %}
            <tr>
                <td>{{ persona.codPersona }}</td>
            <td>{{ persona.nombrePersona }}</td>
            <td>{{ persona.apePat }}</td>
            <td>{{ persona.apeMat }}</td>
            <td>{{ persona.sexo }}</td>
            <td>{{ persona.edad }}</td>
            <td>{{ persona.numeroDocumento }}</td>
            <td>{{ persona.razonSocial }}</td>
            <td>{{ persona.estadoRegistro }}</td>
            <td>{{ persona.usuarioInsercion }}</td>
            <td>{{ persona.fechaInsercion }}</td>
            <td>{{ persona.usuarioModificacion }}</td>
            <td>{{ persona.fechaModificacion }}</td>
            <td>{{ persona.codTipoDocumento }}</td>
            <td>{{ persona.tipoPersona }}</td>
            <td>{{ persona.codEmpresa }}</td>

                <td>{{ link_to("persona/edit/"~persona.codPersona, "Edit") }}</td>
                <td>{{ link_to("persona/delete/"~persona.codPersona, "Delete") }}</td>
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
                <li>{{ link_to("persona/search", "First") }}</li>
                <li>{{ link_to("persona/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("persona/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("persona/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
