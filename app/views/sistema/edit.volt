<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
        {{ link_to("sistema", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
            </div>
<h4><i class='glyphicon glyphicon-edit'></i> Editar Sistema</h4>
</div>
<div class="page-header">
</div>
{{ content() }}

{{ form("sistema/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="table">

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldEtiquetasistema">Etiqueta del Sistema</label>
</div>
    <div class="col-md-3">
{{ form.render('etiquetaSistema') }}
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldUrlsistema">Url Sistema</label>
</div>
    <div class="col-md-3">
{{ form.render('urlSistema') }}
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldUrlicono">Url Icono</label>
</div>
    <div class="col-md-3">
{{ form.render('urlIcono') }}
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldIndicador">Indicador Admin</label>
</div>
    <div class="col-md-3">
{{ form.render('indicadorAdministrador',['class' : 'form-control']) }}
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldEstadoregistro">EstadoRegistro</label>
</div>
    <div class="col-md-3">
{{ form.render('estadoRegistro',['class' : 'form-control']) }}
    </div>
</div>

{{ hidden_field("codSistema") }}

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