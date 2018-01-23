<div class="page-header">
    <h1>
        Search usuario
    </h1>
    <p>
        {{ link_to("usuario/new", "Create usuario") }}
    </p>
</div>

{{ content() }}

{{ form("usuario/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCodusuario" class="col-sm-2 control-label">CodUsuario</label>
    <div class="col-sm-10">
        {{ text_field("codUsuario", "type" : "numeric", "class" : "form-control", "id" : "fieldCodusuario") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNombreusuario" class="col-sm-2 control-label">NombreUsuario</label>
    <div class="col-sm-10">
        {{ text_field("nombreUsuario", "size" : 30, "class" : "form-control", "id" : "fieldNombreusuario") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPasswordusuario" class="col-sm-2 control-label">PasswordUsuario</label>
    <div class="col-sm-10">
        {{ text_field("passwordUsuario", "size" : 30, "class" : "form-control", "id" : "fieldPasswordusuario") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCantidadintentos" class="col-sm-2 control-label">CantidadIntentos</label>
    <div class="col-sm-10">
        {{ text_field("cantidadIntentos", "type" : "numeric", "class" : "form-control", "id" : "fieldCantidadintentos") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIndicadorusuarioadministrador" class="col-sm-2 control-label">IndicadorUsuarioAdministrador</label>
    <div class="col-sm-10">
        {{ text_field("indicadorUsuarioAdministrador", "size" : 30, "class" : "form-control", "id" : "fieldIndicadorusuarioadministrador") }}
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
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        {{ text_field("codEmpresa", "type" : "numeric", "class" : "form-control", "id" : "fieldCodempresa") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodagencia" class="col-sm-2 control-label">CodAgencia</label>
    <div class="col-sm-10">
        {{ text_field("codAgencia", "type" : "numeric", "class" : "form-control", "id" : "fieldCodagencia") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
