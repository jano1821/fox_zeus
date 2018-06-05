<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("producto/new", "<i class='glyphicon glyphicon-plus'></i> Nuevo Producto","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Búsqueda de Productos</h4>
            </div>
            <div class="page-header">
            </div>
            {{ content() }}
            {{ form("producto/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}
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
                            {{ form.render('codProducto') }}
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Categoria</label>
                        </div>
                        <div class="col-xs-4">
                            {{ form.render('codCategoria') }}
                            {{ form.render('categoria') }}
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalCategoria" id="listaCategoria">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Marca</label>
                        </div>
                        <div class="col-xs-4">
                            {{ form.render('codMarca') }}
                            {{ form.render('marca') }}
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalMarca" id="listaMarca">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-4">
                            <label for="fieldCodempresa" >Modelo</label>
                        </div>
                        <div class="col-xs-4">
                            {{ form.render('codModelo') }}
                            {{ form.render('modelo') }}
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalModelo" id="listaModelo">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
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
                        <div class="col-xs-4">
                            {{ select_static('estadoRegistro', ['':'Seleccione Estado...', 'S' : 'Vigente', 'N' : 'No Vigente'], "class": "form-control") }}
                        </div>
                        <div class="col-xs-3">
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
                            {{ link_to("producto/reset", "Limpiar","class":"btn btn-default") }}   
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