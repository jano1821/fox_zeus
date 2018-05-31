<div class="row">
<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
<div class="btn-group pull-right">
{{ link_to("menu_sistema/index/"~codigoUsuario, "<i class='glyphicon glyphicon-chevron-left'></i> Volver","class":"btn btn-info") }}
{{ link_to("menu_sistema/new/"~codigoUsuario, "<i class='glyphicon glyphicon-plus'></i> Nuevo Vinculo Menu Sistema","class":"btn btn-info") }}
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
                <th>Menu</th>
            <th>Sistema</th>
            <th>Usuario</th>
            <th>Estado</th>
                <th></th>
                <th></th>
            </tr>
        <tbody>
        {% if page.items is defined %}
        {% for menu_sistema in page.items %}
            <tr>
                <td>{{ menu_sistema.descripcion }}</td>
            <td>{{ menu_sistema.etiquetaSistema }}</td>
            <td>{{ menu_sistema.nombreUsuario }}</td>
            <td>{{ menu_sistema.estado }}</td>

                <td>{{ link_to("menu_sistema/edit/"~menu_sistema.codMenu~"/"~menu_sistema.codSistema~"/"~menu_sistema.codUsuario, "Editar") }}</td>
                <td>{{ link_to("menu_sistema/delete/"~menu_sistema.codMenu~"/"~menu_sistema.codSistema~"/"~menu_sistema.codUsuario, "Borrar") }}</td>
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
    function paginacion(valor){
        document.getElementById('avance').value = valor;
    }
</script>