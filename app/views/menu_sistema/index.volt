<div class="page-header">
    <h1>
        Search menu_sistema
    </h1>
    <p>
        {{ link_to("menu_sistema/new", "Create menu_sistema") }}
    </p>
</div>

{{ content() }}

{{ form("menu_sistema/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCodmenu" class="col-sm-2 control-label">CodMenu</label>
    <div class="col-sm-10">
        {{ text_field("codMenu", "type" : "numeric", "class" : "form-control", "id" : "fieldCodmenu") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodsistema" class="col-sm-2 control-label">CodSistema</label>
    <div class="col-sm-10">
        {{ text_field("codSistema", "type" : "numeric", "class" : "form-control", "id" : "fieldCodsistema") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodusuario" class="col-sm-2 control-label">CodUsuario</label>
    <div class="col-sm-10">
        {{ text_field("codUsuario", "type" : "numeric", "class" : "form-control", "id" : "fieldCodusuario") }}
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
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
