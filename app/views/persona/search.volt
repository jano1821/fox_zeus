<div class="row">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    {{ link_to("persona", "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
                    {{ link_to("persona/new", "<i class='glyphicon glyphicon-plus'></i> Nueva Persona","class":"btn btn-info") }}
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Resultado de Búsqueda</h4>
            </div>

            <div class="page-header">
            </div>

            {{ content() }}

            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>N° de Doc</th>
                        <th>Razon Social</th>
                        <th>Tipo de Documento</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody>
                        {% if page.items is defined %}
                            {% for persona in page.items %}
                                <tr>
                                    <td>{{ persona.nombrePersona }}</td>
                                    <td>{{ persona.apePat }}</td>
                                    <td>{{ persona.apeMat }}</td>
                                    <td>{{ persona.numeroDocumento }}</td>
                                    <td>{{ persona.razonSocial }}</td>
                                    <td>{{ persona.tipoDocumento }}</td>
                                    <td>{{ persona.nombreEmpresa }}</td>
                                    <td>{{ persona.estado }}</td>
                                    <td>{{ link_to("tipo_persona/index/"~persona.codPersona, "Tipo Persona") }}</td>
                                    <td>{{ link_to("persona/edit/"~persona.codPersona, "class":"btn btn-default","<i class='glyphicon glyphicon-edit'></i>") }}</td>
                                    <td>{{ link_to("persona/delete/"~persona.codPersona, "class":"btn btn-default","<i class='glyphicon glyphicon-trash'></i>") }}</td>
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