<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("horario", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create horario
    </h1>
</div>

{{ content() }}

{{ form("horario/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldHoraingreso" class="col-sm-2 control-label">HoraIngreso</label>
    <div class="col-sm-10">
        {{ text_field("horaIngreso", "size" : 30, "class" : "form-control", "id" : "fieldHoraingreso") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldHorasalida" class="col-sm-2 control-label">HoraSalida</label>
    <div class="col-sm-10">
        {{ text_field("horaSalida", "size" : 30, "class" : "form-control", "id" : "fieldHorasalida") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldHoradescanso" class="col-sm-2 control-label">HoraDescanso</label>
    <div class="col-sm-10">
        {{ text_field("horaDescanso", "size" : 30, "class" : "form-control", "id" : "fieldHoradescanso") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldHoraretorno" class="col-sm-2 control-label">HoraRetorno</label>
    <div class="col-sm-10">
        {{ text_field("horaRetorno", "size" : 30, "class" : "form-control", "id" : "fieldHoraretorno") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEstadoregistro" class="col-sm-2 control-label">EstadoRegistro</label>
    <div class="col-sm-10">
        {{ text_field("estadoRegistro", "size" : 30, "class" : "form-control", "id" : "fieldEstadoregistro") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUsuarioinsercion" class="col-sm-2 control-label">UsuarioInsercion</label>
    <div class="col-sm-10">
        {{ text_field("usuarioInsercion", "size" : 30, "class" : "form-control", "id" : "fieldUsuarioinsercion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFechainsercion" class="col-sm-2 control-label">FechaInsercion</label>
    <div class="col-sm-10">
        {{ text_field("fechaInsercion", "size" : 30, "class" : "form-control", "id" : "fieldFechainsercion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUsuariomodificacion" class="col-sm-2 control-label">UsuarioModificacion</label>
    <div class="col-sm-10">
        {{ text_field("usuarioModificacion", "size" : 30, "class" : "form-control", "id" : "fieldUsuariomodificacion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFechamodificacion" class="col-sm-2 control-label">FechaModificacion</label>
    <div class="col-sm-10">
        {{ text_field("fechaModificacion", "size" : 30, "class" : "form-control", "id" : "fieldFechamodificacion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodpersona" class="col-sm-2 control-label">CodPersona</label>
    <div class="col-sm-10">
        {{ text_field("codPersona", "type" : "numeric", "class" : "form-control", "id" : "fieldCodpersona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldHoraingresosabatino" class="col-sm-2 control-label">HoraIngresoSabatino</label>
    <div class="col-sm-10">
        {{ text_field("horaIngresoSabatino", "size" : 30, "class" : "form-control", "id" : "fieldHoraingresosabatino") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldHorasalidasabatino" class="col-sm-2 control-label">HoraSalidaSabatino</label>
    <div class="col-sm-10">
        {{ text_field("horaSalidaSabatino", "size" : 30, "class" : "form-control", "id" : "fieldHorasalidasabatino") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
