<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("ubicacion", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create ubicacion
    </h1>
</div>

{{ content() }}

{{ form("ubicacion/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCodsecion" class="col-sm-2 control-label">CodSecion</label>
    <div class="col-sm-10">
        {{ text_field("codSecion", "type" : "numeric", "class" : "form-control", "id" : "fieldCodsecion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodzona" class="col-sm-2 control-label">CodZona</label>
    <div class="col-sm-10">
        {{ text_field("codZona", "type" : "numeric", "class" : "form-control", "id" : "fieldCodzona") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodsector" class="col-sm-2 control-label">CodSector</label>
    <div class="col-sm-10">
        {{ text_field("codSector", "type" : "numeric", "class" : "form-control", "id" : "fieldCodsector") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodalmacen" class="col-sm-2 control-label">CodAlmacen</label>
    <div class="col-sm-10">
        {{ text_field("codAlmacen", "type" : "numeric", "class" : "form-control", "id" : "fieldCodalmacen") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodempresa" class="col-sm-2 control-label">CodEmpresa</label>
    <div class="col-sm-10">
        {{ text_field("codEmpresa", "type" : "numeric", "class" : "form-control", "id" : "fieldCodempresa") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodproducto" class="col-sm-2 control-label">CodProducto</label>
    <div class="col-sm-10">
        {{ text_field("codProducto", "type" : "numeric", "class" : "form-control", "id" : "fieldCodproducto") }}
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
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
