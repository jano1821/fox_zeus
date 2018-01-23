<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("parametros_generales", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit parametros_generales
    </h1>
</div>

{{ content() }}

{{ form("parametros_generales/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldIdentificadorparametro" class="col-sm-2 control-label">IdentificadorParametro</label>
    <div class="col-sm-10">
        {{ text_field("identificadorParametro", "size" : 30, "class" : "form-control", "id" : "fieldIdentificadorparametro") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldValorparametro" class="col-sm-2 control-label">ValorParametro</label>
    <div class="col-sm-10">
        {{ text_field("valorParametro", "size" : 30, "class" : "form-control", "id" : "fieldValorparametro") }}
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
    <label for="fieldIndicadorfijo" class="col-sm-2 control-label">IndicadorFijo</label>
    <div class="col-sm-10">
        {{ text_field("indicadorFijo", "size" : 30, "class" : "form-control", "id" : "fieldIndicadorfijo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        {{ text_field("codEmpresa", "type" : "numeric", "class" : "form-control", "id" : "fieldCodempresa") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
