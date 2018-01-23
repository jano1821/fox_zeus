<div class="page-header">
    <h1>
        Search persona
    </h1>
    <p>
        {{ link_to("persona/new", "Create persona") }}
    </p>
</div>

{{ content() }}

{{ form("persona/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCodpersona" class="col-sm-2 control-label">CodPersona</label>
    <div class="col-sm-10">
        {{ text_field("codPersona", "type" : "numeric", "class" : "form-control", "id" : "fieldCodpersona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNombrepersona" class="col-sm-2 control-label">NombrePersona</label>
    <div class="col-sm-10">
        {{ text_field("nombrePersona", "size" : 30, "class" : "form-control", "id" : "fieldNombrepersona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldApepat" class="col-sm-2 control-label">ApePat</label>
    <div class="col-sm-10">
        {{ text_field("apePat", "size" : 30, "class" : "form-control", "id" : "fieldApepat") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldApemat" class="col-sm-2 control-label">ApeMat</label>
    <div class="col-sm-10">
        {{ text_field("apeMat", "size" : 30, "class" : "form-control", "id" : "fieldApemat") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSexo" class="col-sm-2 control-label">Sexo</label>
    <div class="col-sm-10">
        {{ text_field("sexo", "size" : 30, "class" : "form-control", "id" : "fieldSexo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEdad" class="col-sm-2 control-label">Edad</label>
    <div class="col-sm-10">
        {{ text_field("edad", "type" : "numeric", "class" : "form-control", "id" : "fieldEdad") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNumerodocumento" class="col-sm-2 control-label">NumeroDocumento</label>
    <div class="col-sm-10">
        {{ text_field("numeroDocumento", "size" : 30, "class" : "form-control", "id" : "fieldNumerodocumento") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRazonsocial" class="col-sm-2 control-label">RazonSocial</label>
    <div class="col-sm-10">
        {{ text_field("razonSocial", "size" : 30, "class" : "form-control", "id" : "fieldRazonsocial") }}
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
    <label for="fieldCodtipodocumento" class="col-sm-2 control-label">CodTipoDocumento</label>
    <div class="col-sm-10">
        {{ text_field("codTipoDocumento", "type" : "numeric", "class" : "form-control", "id" : "fieldCodtipodocumento") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTipopersona" class="col-sm-2 control-label">TipoPersona</label>
    <div class="col-sm-10">
        {{ text_field("tipoPersona", "size" : 30, "class" : "form-control", "id" : "fieldTipopersona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        {{ text_field("codEmpresa", "type" : "numeric", "class" : "form-control", "id" : "fieldCodempresa") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
