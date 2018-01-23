<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("empleado", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit empleado
    </h1>
</div>

{{ content() }}

{{ form("empleado/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCodpersona" class="col-sm-2 control-label">CodPersona</label>
    <div class="col-sm-10">
        {{ text_field("codPersona", "type" : "numeric", "class" : "form-control", "id" : "fieldCodpersona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodtipoempleado" class="col-sm-2 control-label">CodTipoEmpleado</label>
    <div class="col-sm-10">
        {{ text_field("codTipoEmpleado", "type" : "numeric", "class" : "form-control", "id" : "fieldCodtipoempleado") }}
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


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
