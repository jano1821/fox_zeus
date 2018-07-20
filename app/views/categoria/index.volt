{{ content() }}
{{ partial("inventory/title") }}
{{ partial("inventory/head") }}
<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ link_to("categoria/new", "<i class='glyphicon glyphicon-plus'></i> Nueva Categoria","class":"btn btn-info") }}
            </div>
            <div class="page-header">
            </div>
            {{ form("categoria/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

            <div class="table">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldDescripcion">Descripcion</label>
                        </div>
                        <div class="col-xs-5">
                            {{ form.render('descripcion') }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldEstadoregistro">Estado de Registro</label>
                        </div>
                        <div class="col-xs-5">
                            {{ form.render('estadoRegistro',['class' : 'form-control']) }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-4">
                            {{ form.render('buscar') }}
                            {{ link_to("categoria/reset", "Limpiar","class":"btn btn-default") }}   
                            {{ form.render('csrf', ['value': security.getToken()]) }}
                        </div>
                        <div class="col-xs-3">

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{ partial("inventory/footer") }}