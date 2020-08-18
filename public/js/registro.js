$(document).ready(function () {
    $('.modal').modal({
        dismissible: false,
    });
    $('#entrega1').hide();
    $('#entrega2').hide()

    $("#FormRegistro").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/Registro/Update",
            type: 'POST',
            data: $("#FormRegistro").serialize(),
            datatype: "JSON",
            beforeSend: process(true, "Registrando, espere un momento"),
            success: function (response) {
                process(false, 'Registrado');
                ResponseAlert(response.status, response.msg);
                if (response.status == "success") {
                    window.setTimeout(function () {
                        location.href = "/tienda/FinalizarCompra";
                    }, 1000);
                }
            },
            error: function (e) {
                ResponseAlert("error", "Error de servidor, vuelve a cargar la página");
            }
        });
    });

    $("#formFinalizar").submit(function (event) {
        event.preventDefault();
        Swal.fire({
            text: "Finalizar Compra, estas seguro de continuar?",
            showCancelButton: true,
            confirmButtonColor: '#546e7a',
            cancelButtonColor: '#ff5252',
            confirmButtonText: 'Si, Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "/Registro/Terminar",
                    type: 'POST',
                    data: $("#formFinalizar").serialize(),
                    datatype: "JSON",
                    beforeSend: process(true, "Finalizando compra, espere un momento"),
                    success: function (response) {
                        process(false, 'finalizado');
                        if (response.status == "success") {
                            ResponseAlert(response.status, "Proceso finalizado con éxito");
                            $("#numeropedido").html(response.numpedido);
                            var total = parseFloat(response.total);
                            $("#respuestatotal").html("$" + total.toFixed(2));
                            var tipo = response.idenvio;
                            if (tipo == 1) {
                                $('#entrega1').show();
                                $('#entrega2').hide();
                            } else {
                                $('#entrega2').show();
                                $('#entrega1').hide();
                            }
                            $("#modal1").modal("open");
                        } else {
                            ResponseAlert(response.status, response.msg);
                        }
                    },
                    error: function (e) {
                        ResponseAlert("error", "Error de servidor, vuelve a cargar la página");
                    }
                });
            }
        })
    });
});


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

function sumartotal(item) {
    var obj = item.id;
    var id = obj.split("-")[1];
    var cantidad = parseFloat(item.value);
    var subtotal = $("#subtotal").val();
    var suma = parseFloat(cantidad) + parseFloat(subtotal);
    $("#htmlenvio").html(cantidad.toFixed(2));
    $("#htmltotal").html(suma.toFixed(2));
    $("#total").val(suma.toFixed(2));
    $("#eleccionenvio").val(id);
}
