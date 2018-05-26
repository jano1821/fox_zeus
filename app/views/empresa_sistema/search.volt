<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("empresa_sistema/index/"~codigoEmpresa, "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
                    {{ link_to("empresa_sistema/new/"~codigoEmpresa, "<i class='glyphicon glyphicon-plus'></i> Nuevo Vinculo Menu Sistema","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Resultado de Busqueda</h4>
            </div>

            <div class="page-header">
            </div>

            {{ content() }}

            {{ form("sistema/search/"~codigoEmpresa, "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}
            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Empresa</th>
                        <th>Sistema</th>
                        <th>Estado de Registro</th>

                        <th></th>
                        <th></th>
                    </tr>
                    <tbody>
                        {% if page.items is defined %}
                            {% for empresa_sistema in page.items %}
                                <tr>
                                    <td>{{ empresa_sistema.nombreEmpresa }}</td>
                                    <td>{{ empresa_sistema.etiquetaSistema }}</td>
                                    <td>{{ empresa_sistema.estado }}</td>

                                    <td>{{ link_to("empresa_sistema/edit/"~empresa_sistema.codEmpresa~"/"~empresa_sistema.codSistema, "Editar") }}</td>
                                    <td>{{ link_to("empresa_sistema/delete/"~empresa_sistema.codEmpresa~"/"~empresa_sistema.codSistema, "Borrar") }}</td>
                                </tr>
                            {% endfor %}
                        {% endif %}
                    </tbody>
                </table>
            </div>

            {{ hidden_field("pagina") }}
            {{ hidden_field("avance") }}
            {{ hidden_field("codUsuario") }}

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