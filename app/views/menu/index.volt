<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Panel de Control</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
        <script src="js/modernizr.custom.js"></script>
    </head>
    <body>
        <div class="container">	
            <!-- Codrops top bar -->
            <div class="codrops-top clearfix">
                <span class="right">{{ link_to("index/logout", "Cerrar Sesión", "class":"codrops-icon codrops-icon-drop") }}</span>
            </div>
            <header>
                <h1>Panel de Control Central <span>Selecciona la Opción a la que Necesitas</span></h1>	
            </header>
            <div class="main clearfix">
                {% if menu is defined %}
                    {% for items in menu %}
                        <nav id={{items.id}} class="nav">
                            <ul>
                                {% if menuSistema is defined %}
                                    {% for sistema in menuSistema %}
                                        {% if sistema.codMenu == items.codMenu %}
                                        <li>
                                            <a href="{{sistema.url}}">
                                                <span class="icon">
                                                    <i aria-hidden="true" class="{{sistema.urlIcono}}"></i>
                                                </span>
                                                <span>{{sistema.etiquetaSistema}}</span>
                                            </a>
                                        </li>
                                        {% endif %}
                                    {% endfor %}
                                {% endif %}
                            </ul>
                        </nav>
                    {% endfor %}
                {% endif %}
            </div>
        </div>
        <script type="text/javascript">
            var changeClass = function (r, className1, className2) {
                var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
                if (regex.test(r.className)) {
                    r.className = r.className.replace(regex, ' ' + className2 + ' ');
                } else {
                    r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"), ' ' + className1 + ' ');
                }
                return r.className;
            };
            {% if menu is defined %}
                    {% for items in menu %}
                        var menuElements{{items.orden}} = document.getElementById("{{items.id}}");
                        menuElements{{items.orden}}.insertAdjacentHTML('afterBegin', '<button type="button" id="{{items.idBoton}}" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> {{items.nombreBoton}}</button>');
                        document.getElementById("{{items.idBoton}}").onclick = function () { changeClass(this, 'navtoogle active', 'navtoogle');};
                    {% endfor %}
                {% endif %}
        </script>
    </body>
</html>