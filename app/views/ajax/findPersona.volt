<div class="modal fade bs-example-modal-lg" id="myModalPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
            <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Buscar Persona</h4>
            </div>
            <div class="modal-body">
		  <div class="form-group">
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="labelBusquedaPersona" placeholder="Buscar Persona">
			</div>
			<div id="buscar">
                        <button class="btn btn-default" id="listaPersona">
                            <span class='glyphicon glyphicon-search'></span> Buscar
                        </button>
                        </div>
		  </div>
		<div id="loader" style="position: absolute;text-align:center;top:55px;width:100%;display:none;">
                </div><!-- Carga gif animado -->
                <div class="table-responsive">
                    <div id="contentPersona">
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
    function agregarPersona(codPersona,nombrePersona){
        document.getElementById("codPersona").value = codPersona;
        document.getElementById("nombrePersona").value = nombrePersona;        
    }
</script>