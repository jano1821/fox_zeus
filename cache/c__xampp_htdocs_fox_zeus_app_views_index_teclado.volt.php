<div class="modal fade bs-example-modal-lg" id="myModalTeclado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Teclado Virtual</h4>
            </div>
            
            <div class="container col-md-offset-3">
                <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(1);">1</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(2);">2</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(3);">3</button>
                </div>
                <br>
                <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(4);">4</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(5);">5</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(6);">6</button>
                </div>
                <br>
                <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(7);">7</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(8);">8</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(9);">9</button>
                </div>
                <br>
                <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(0);">0</button>
                        <button type="button" class="btn btn-primary" onclick="agregarNumero(-1);">limpiar</button>
                </div>
            </div>

            <div class="modal-footer">
                <h4 class="text-center">
                <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </h4>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function agregarNumero(valor){
        if(valor<0){
            document.forms[0].password.value =  "";
        }else{
            document.forms[0].password.value =  document.forms[0].password.value + valor;
        }
    }
</script>