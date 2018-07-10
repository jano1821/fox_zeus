{{ content() }}
{{ partial("inventory/title") }}
{{ partial("inventory/head") }}
<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ link_to("categoria/new", "<i class='glyphicon glyphicon-plus'></i> Nueva Categoria","class":"btn btn-info") }}
                {{ link_to("categoria/index", "<i class='glyphicon glyphicon-search'></i> Buscar Categoria","class":"btn btn-info") }}
            </div>


            {{ form("sistema/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}
            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Descripcion</th>
                        <th>Estado</th>

                        <th></th>
                        <th></th>
                    </tr>
                    <tbody>
                        {% if page.items is defined %}
                            {% for categoria in page.items %}
                                <tr>
                                    <td>{{ categoria.descripcion }}</td>
                                    <td>{{ categoria.estado }}</td>

                                    <td>{{ link_to("categoria/edit/"~categoria.codCategoria,"class":"btn btn-default","<i class='glyphicon glyphicon-edit'></i>") }}</td>
                                    <td>{{ link_to("categoria/delete/"~categoria.codCategoria, "class":"btn btn-default","<i class='glyphicon glyphicon-trash'></i>") }}</td>
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