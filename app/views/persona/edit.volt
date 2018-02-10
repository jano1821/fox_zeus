<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("persona", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
                    {{ link_to("tipo_persona", "<i class='glyphicon glyphicon-sunglasses'></i> Definir Tipo de Persona","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Editar Persona</h4>
            </div>
            <div class="page-header">
        </div>

{{ content() }}

{{ form("persona/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="table">

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldNombrepersona">Nombre de Persona</label>
</div>
                    <div class="col-md-3">
{{ form.render('nombrePersona') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldApepat" >Apellido Paterno</label>
</div>
                    <div class="col-md-3">
        {{ form.render('apePat') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldApemat">Apellido Materno</label>
</div>
                    <div class="col-md-3">
{{ form.render('apeMat') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldSexo" >Sexo</label>
</div>
                    <div class="col-md-3">
{{ form.render('sexo',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldEdad">Edad</label>
</div>
                    <div class="col-md-3">
{{ form.render('edad') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldCodtipodocumento">Tipo de Documento</label>
</div>
                    <div class="col-md-3">
{% if tipoDocumento is defined %}
{{ select("codTipoDocumento", tipoDocumento,'useEmpty': true, 'emptyText': 'Seleccione Tipo Documento...', 'emptyValue': '', 'using': ['codTipoDocumento', 'descripcion'], "class" : "form-control") }}
{% endif %}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldNumerodocumento" >Numero de Documento</label>
</div>
                    <div class="col-md-3">
{{ form.render('numeroDocumento') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldRazonsocial">Razon Social</label>
</div>
                    <div class="col-md-3">
    {{ form.render('razonSocial') }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldTipopersona">Tipo de Persona</label>
</div>
                    <div class="col-md-3">
{{ form.render('tipoPersona',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
    <label for="fieldEstadoregistro" >Estado de Registro</label>
</div>
                    <div class="col-md-3">
        {{ form.render('estadoRegistro',['class' : 'form-control']) }}
    </div>
</div>

{{ hidden_field("codPersona") }}

<div class="form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        {{ form.render('save') }}
                        {{ form.render('csrf', ['value': security.getToken()]) }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>