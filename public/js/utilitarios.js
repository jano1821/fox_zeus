var segundo = 0;
window.setTimeout('mostrar()', 100);
function mostrar() {
    var etiqueta;

    if (tiempo == 0 && segundo == 0) {
        document.location.href = "index/logout";
    }

    etiqueta = completar(2, "" + tiempo, "0") + ":" + completar(2, "" + segundo, "0");

    if (segundo == 0) {
        tiempo--;
        segundo = 60;
    }

    segundo--;

    document.getElementById('hora').innerHTML = 'Tiempo Restante: ' + etiqueta;
    window.setTimeout('mostrar()', 1000);
}
function completar(len, cadena, caracter) {
    while (cadena.length < len) {
        cadena = caracter + cadena;
    }
    return cadena;
}

function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key == 8))
}