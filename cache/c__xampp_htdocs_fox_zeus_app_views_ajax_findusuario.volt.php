<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
            <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Buscar Usuario</h4>
            </div>
            <div class="modal-body">
		  <div class="form-group">
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="labelBusquedaUsuario" placeholder="Buscar Usuarios">
			</div>
			<div id="buscar">
                        <button class="btn btn-default" id="listaUsuarios">
                            <span class='glyphicon glyphicon-search'></span> Buscar
                        </button>
                        </div>
		  </div>
		<div id="loader" style="position: absolute;text-align:center;top:55px;width:100%;display:none;">
                </div><!-- Carga gif animado -->
                <div class="table-responsive">
                    <div id="content">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
	</div>
  </div>
</div>
<script type="text/javascript">
    function agregarUsuario(idUsuario,nombreUsuario){
        document.getElementById("codUsuario").value = idUsuario;
        document.getElementById("nombreUsuario").value = nombreUsuario;        
    }
</script>