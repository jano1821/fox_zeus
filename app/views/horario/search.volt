<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("horario/index", "Go Back") }}</li>
            <li class="next">{{ link_to("horario/new", "Create ") }}</li>
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
                <th>CodHorario</th>
            <th>HoraIngreso</th>
            <th>HoraSalida</th>
            <th>HoraDescanso</th>
            <th>HoraRetorno</th>
            <th>EstadoRegistro</th>
            <th>UsuarioInsercion</th>
            <th>FechaInsercion</th>
            <th>UsuarioModificacion</th>
            <th>FechaModificacion</th>
            <th>CodPersona</th>
            <th>HoraIngresoSabatino</th>
            <th>HoraSalidaSabatino</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for horario in page.items %}
            <tr>
                <td>{{ horario.codHorario }}</td>
            <td>{{ horario.horaIngreso }}</td>
            <td>{{ horario.horaSalida }}</td>
            <td>{{ horario.horaDescanso }}</td>
            <td>{{ horario.horaRetorno }}</td>
            <td>{{ horario.estadoRegistro }}</td>
            <td>{{ horario.usuarioInsercion }}</td>
            <td>{{ horario.fechaInsercion }}</td>
            <td>{{ horario.usuarioModificacion }}</td>
            <td>{{ horario.fechaModificacion }}</td>
            <td>{{ horario.codPersona }}</td>
            <td>{{ horario.horaIngresoSabatino }}</td>
            <td>{{ horario.horaSalidaSabatino }}</td>

                <td>{{ link_to("horario/edit/"~horario.codHorario, "Edit") }}</td>
                <td>{{ link_to("horario/delete/"~horario.codHorario, "Delete") }}</td>
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
                <li>{{ link_to("horario/search", "First") }}</li>
                <li>{{ link_to("horario/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("horario/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("horario/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
