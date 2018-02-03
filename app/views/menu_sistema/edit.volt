<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
        {{ link_to("menu_sistema", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
            </div>
<h4><i class='glyphicon glyphicon-edit'></i> Editar Vinculo Menu Sistema</h4>
</div>
<div class="page-header">
</div>

{{ content() }}

{{ form("menu_sistema/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="table">

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldCodmenu" class="col-sm-2 control-label">CodMenu</label>
</div>
                    <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            {{ form.render('nombreMenu') }}
                            {{ form.render('codMenu') }}
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalMenu" id="listaMenu">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldCodsistema" class="col-sm-2 control-label">CodSistema</label>
    </div>
<div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
                {{ form.render('nombreSistema') }}
                {{ form.render('codSistema') }}
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalSistema" id="listaSistemas">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
<div class="col-md-3">
</div>
<div class="col-md-2">
    <label for="fieldCodusuario" class="col-sm-2 control-label">CodUsuario</label>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
                {{ form.render('nombreUsuario') }}
                {{ form.render('codUsuario') }}
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="listaUsuarios">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
    </div>
    <div class="col-md-2">
        <label for="fieldEstadoregistro">Estado Registro</label>
    </div>
    <div class="col-md-3">
        {{ form.render('estadoRegistro',['class' : 'form-control']) }}
    </div>
</div>




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






<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#listaMenu').on("click",function(e){
            e.preventDefault();
            var params = "busquedaMenu="+document.getElementById("labelBusquedaMenu").value;
            $("#contentMenu").html("Cargando Contenido.......");
            $.post("{{ url('menu_sistema/ajaxPostMenu') }}", 
                    params, 
                    function(data) {
                        $("#contentMenu").html(data.res.codigo);
                    }).fail(function() {
                        $("#contentMenu").html("No hay Resultados");
                    })
        });
    });

    $(document).ready(function() {
        $('#listaUsuarios').on("click",function(e){
            e.preventDefault();
            var params = "busquedaUsuario="+document.getElementById("labelBusquedaUsuario").value;
            $("#content").html("Cargando Contenido.......");
            $.post("{{ url('menu_sistema/ajaxPostUsuario') }}", 
                    params, 
                    function(data) {
                        $("#content").html(data.res.codigo);
                    }).fail(function() {
                        $("#content").html("No hay Resultados");
                    })
        });
    });

    $(document).ready(function(){
        $("#listaSistemas").click(function(e){
            e.preventDefault();
            var params = "busquedaSistema="+document.getElementById("labelBusquedaSistema").value;
            $("#contentSistema").html("Cargando Contenido.......");
            $.post("{{ url('menu_sistema/ajaxPostSistema') }}", 
                    params, 
                    function(data) {
                        $("#contentSistema").html(data.res.codigo);
                    }).fail(function() {
                        $("#contentSistema").html("No hay Resultados");
                    })
        });
    });

    
</script>