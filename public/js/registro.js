function CopyForm() {
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();
    var direccion = $("#direccion").val();
    var cp = $("#cp").val();
    var ciudad = $("#ciudad").val();
    var pais = $("#pais").val();
    if ($('#identicos').is(':checked')) {
        $("#recibe").val(nombre + " " + apellido);
        $("#telefonorecibe").val(telefono);
        $("#direccionrecibe").val(direccion);
        $("#cprecibe").val(cp);
        $("#ciudadrecibe").val(ciudad);
        $("#paisrecibe").val(pais);
    } else {
        $("#recibe").val("");
        $("#telefonorecibe").val("");
        $("#direccionrecibe").val("");
        $("#cprecibe").val("");
        $("#ciudadrecibe").val("");
        $("#paisrecibe").val("");
    }
}
