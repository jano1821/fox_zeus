<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
{{ link_to("persona", "<i class='glyphicon glyphicon-chevron-left'></i> Volver a Personas","class":"btn btn-info") }}
{{ link_to("menu", "<i class='glyphicon glyphicon-chevron-left'></i> Volver al Menu","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Agencias</h4>
            </div>
            <div class="page-header">
        </div>
{{ content() }}

{{ form("agencia/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="table">

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldDescripcion">Empleado</label>
</div>
                    <div class="col-md-3">
        {{ form.render('empleado',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldEstadoregistro">Cliente</label>
</div>
                    <div class="col-md-3">
        {{ form.render('cliente',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldEstadoregistro">Proveedor</label>
</div>
                    <div class="col-md-3">
        {{ form.render('proveedor',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        {{ form.render('save') }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>