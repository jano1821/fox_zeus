<nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav nav-tabs">
            {% if menuPrincipal is defined %}
                {% for items in menuPrincipal %}
                    {% if items.urlSubmenu == '#' and items.indicadorMenuPrincipal == 'S' %}
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ items.descripcion }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                {% if menuSecundario is defined %}
                                    {% for secundario in menuSecundario %}
                                        {% if secundario.urlSubmenu != '#' and items.codSubMenu == secundario.codMenuPadre %} 
                                            <li><a href="{{ secundario.urlSubmenu~"/"~secundario.codSistema }}">{{ secundario.descripcion }}</a></li>
                                            {% endif %}
                                            {% if secundario.indicadorSeparador == 'S' and items.codSubMenu == secundario.codMenuPadre %} 
                                                {{ secundario.descripcion }}
                                            {% endif %}
                                        {% endfor %}
                                    {% endif %}
                            </ul>
                        </li>
                    {% endif %}

                    {% if items.urlSubmenu != '#' and items.indicadorMenuPrincipal == 'S' %}
                        <li role="presentation"><a href="{{items.urlSubmenu}}">{{ items.descripcion }}</a></li>
                        {% endif %}
                    {% endfor %}
                {% endif %}
        </ul>
    </div>
</nav>