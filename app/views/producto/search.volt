<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("producto", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
                    {{ link_to("producto/new", "<i class='glyphicon glyphicon-plus'></i> Nuevo Sistema","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Resultado de Busqueda</h4>
            </div>

            <div class="page-header">
            </div>

            {{ content() }}
            {{ form("sistema/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}
            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Descripcion</th>
                        <th>FechaBaja</th>
                        <th>MotivoBaja</th>
                        <th>EstadoRegistro</th>
                        <th>CodCategoria</th>
                        <th>CodMarca</th>
                        <th>CodModelo</th>
                        <th>DescripcionCorta</th>
                        <th>FechaVencimiento</th>
                        <th>FechaAlta</th>

                        <th></th>
                        <th></th>
                    </tr>
                    <tbody>
                        {% if page.items is defined %}
                            {% for producto in page.items %}
                                <tr>
                                    <td>{{ producto.descripcion }}</td>
                                    <td>{{ producto.fechaBaja }}</td>
                                    <td>{{ producto.motivoBaja }}</td>
                                    <td>{{ producto.estadoRegistro }}</td>
                                    <td>{{ producto.codCategoria }}</td>
                                    <td>{{ producto.codMarca }}</td>
                                    <td>{{ producto.codModelo }}</td>
                                    <td>{{ producto.descripcionCorta }}</td>
                                    <td>{{ producto.fechaVencimiento }}</td>
                                    <td>{{ producto.fechaAlta }}</td>

                                    <td>{{ link_to("producto/edit/"~producto.codProducto, "Edit") }}</td>
                                    <td>{{ link_to("producto/delete/"~producto.codProducto, "Delete") }}</td>
                                </tr>
                            {% endfor %}
                        {% endif %}
                    </tbody>
                </table>
            </div>

            {{ hidden_field("pagina") }}
            {{ hidden_field("avance") }}

            <div class="row">
                <div class="col-sm-2">
                    <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                        {{ "Página "~page.current~" de "~page.total_pages }}
                    </p>
                </div>
                <div class="col-sm-10">
                    <nav>
                        <ul class="pagination">
                            {{ submit_button('Primero', 'class': 'btn btn-info','onclick':'paginacion(0);') }}
                            {{ submit_button('Anterior', 'class': 'btn btn-info','onclick':'paginacion(-1);') }}
                            {{ submit_button('Siguiente', 'class': 'btn btn-info','onclick':'paginacion(1);') }}
                            {{ submit_button('Ultimo', 'class': 'btn btn-info','onclick':'paginacion(2);') }}
                        </ul>
                    </nav>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function paginacion(valor) {
        document.getElementById('avance').value = valor;
    }
</script>