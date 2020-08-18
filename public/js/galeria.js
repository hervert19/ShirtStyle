 $(window).on("load", function () {
     $('#page-loader').fadeOut(500);
 });

 $(document).ready(function () {
     $('.sidenav').sidenav();
     $('.carousel').carousel();
     $('.materialboxed').materialbox();
     $('select').formSelect();
     $('.collapsible').collapsible();
     $('.tooltipped').tooltip();
     $('.fixed-action-btn').floatingActionButton();

     $("#Filtrar").on('click', function () {
         var datos = [];
         datos[0] = $("#fitrodescripcion").val();
         datos[1] = $("#filtrocolor").val();
         datos[2] = $("#filtromarca").val();
         datos[3] = $("#input-min").val();
         datos[4] = $("#input-max").val();
         var dato = btoa(datos.toString());
         window.location = "/" + dato;
         $('#page-loader').fadeOut(500);
     });
 });

 function ChangeImage(value) {
     var id = value.id;
     var temp = value.src;
     var second = $("#" + id + "two").val();
     $("#" + id).attr("src", second);
     $("#" + id + "two").val(temp);
 }

 function ReturnImage(value) {
     var id = value.id;
     var temp = value.src;
     var second = $("#" + id + "two").val();
     $("#" + id).attr("src", second);
     $("#" + id + "two").val(temp);
 }

 function ViewImage(value) {
     $("#imagencentral").attr("src", value.src);
 }

 function CalcularProducto() {
     var precio = $("#formprecio").val();
     var cantidad = $("#formcantidad").val();
     var total = parseFloat(precio) * parseFloat(cantidad);
     if (isNaN(total)) {
         total = 0;
     }
     $("#formtotal").val("$ " + total.toFixed(2));
 }

 function getFormData(value) {
     var string = value.id;
     var codigo = string.split("-")[1];
     var idproducto = string.split("-")[2];
     var talla = $("#talla" + codigo).val();
     var cantidad = $("#cantidad" + codigo).val();
     if (cantidad > 0) {
         CallInsertProduct(idproducto, talla, cantidad);
     } else {
         ResponseAlert("warning", "El minimo para agregar el artículo es 1.");
     }
 }

 function process(valor, cadena) {
     let val = valor;
     let timerInterval;
     let aux = 50000;
     if (val == false) {
         aux = 100;
     }
     var spinner = '<div class="progress"><div class="indeterminate"></div></div>';
     Swal.fire({
         html: "<h6>" + cadena + "</h6><br>" + spinner,
         timer: aux,
         width: 300,
         allowOutsideClick: false,
         showConfirmButton: false,
         onClose: () => {
             clearInterval(timerInterval)
         }
     })
 }

 function DetallesAdd() {
     var idproducto = $("#formidproducto").val();
     var talla = $("#formtalla").val();
     var cantidad = $("#formcantidad").val();
     if (cantidad <=
         0 || cantidad == "") {
         ResponseAlert("warning", "El minimo para agregar el artículo es 1.");
     } else {
         CallInsertProduct(idproducto, talla, cantidad);
     }
 }

 function getFormDelete(value) {
     var string = value.id;
     var idcarrito = string.split("-")[1];
     DeleteArt(idcarrito);
 }

 function CallInsertProduct(idproducto, talla, cantidad) {
     $.ajax({
         url: "/camisas/insertar",
         type: 'POST',
         data: {
             "_token": $("meta[name='csrf-token']").attr("content"),
             "idproducto": idproducto,
             "talla": talla,
             "cantidad": cantidad,
         },
         datatype: 'JSON',
         beforeSend: process(true, "Agregando producto, espere un momento"),
         success: function (response) {
             process(false, 'agregado');
             ResponseAlert(response.status, response.msg);
             if (response.status == "success") {
                 AddArticulo(response.cantidadcarrito);
             }
         },
         error: function (r) {
             ResponseAlert("error", "Error de servidor, vuelve a cargar la página");
         },
     });
 }

 function DeleteArt(idcarrito) {
     $.ajax({
         url: "/camisas/eliminar",
         type: 'POST',
         data: {
             "_token": $("meta[name='csrf-token']").attr("content"),
             "idcarrito": idcarrito,
         },
         datatype: 'JSON',
         beforeSend: process(true, "Eliminando producto, espere un momento"),
         success: function (response) {
             process(false, 'eliminado');
             ResponseAlert(response.status, response.msg);
             if (response.status == "success") {
                 RemoveArticulo(response.cantidadcarrito);
                 history.go(0);
             }
         },
         error: function (r) {
             ResponseAlert("error", "Error de servidor, vuelve a cargar la página");
         },
     });
 }

 function AddArticulo(cantidad) {
     var total = $("#TotalCarrito").html();
     var sumatotal = parseInt(total) + parseInt(cantidad);
     $("#TotalCarrito").html(sumatotal);
 }

 function RemoveArticulo(cantidad) {
     var total = $("#TotalCarrito").html();
     var sumatotal = parseInt(total) - parseInt(cantidad);
     $("#TotalCarrito").html(sumatotal);
 }

 function ChangeItem(value) {
     var string = value.id;
     var operacion = string.split("-")[0];
     var idcarrito = string.split("-")[1];
     var cantidad = $("#cant-" + idcarrito).val();
     if (operacion == "remove" && cantidad == 1) {
         LimiteMenor(idcarrito);
     } else {
         $.ajax({
             url: "/camisas/actualizar",
             type: 'POST',
             data: {
                 "_token": $("meta[name='csrf-token']").attr("content"),
                 "idcarrito": idcarrito,
                 "operacion": operacion,
                 "cantidad": cantidad,
             },
             datatype: 'JSON',
             beforeSend: process(true, "Actualizando carrito, espere un momento"),
             success: function (response) {
                 process(false, 'actualizado');
                 ResponseAlert(response.status, response.msg);
                 if (response.status == "success") {
                     history.go(0);
                 }
             },
             error: function (r) {
                 ResponseAlert("error", "Error de servidor, vuelve a cargar la página");
             },
         });
     }
 }

 function LimiteMenor(idcarrito) {
     Swal.fire({
         text: "La cantidad miníma de artículos es 1, desea eliminarlo?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#546e7a',
         cancelButtonColor: '#ff5252',
         confirmButtonText: 'Si, eliminar',
         cancelButtonText: 'Cancelar'
     }).then((result) => {
         if (result.value) {
             DeleteArt(idcarrito);
         }
     })
 }

 function ResponseAlert(status, msg) {
     const Toast = Swal.mixin({
         toast: true,
         position: 'center-end',
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,
         onOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
     })
     var color = "";
     if (status == "success") {
         color = '#40c267';
     } else if (status == "error") {
         color = '#ff5252'
     } else {
         color = '#f57f17';
     }

     Toast.fire({
         icon: status,
         title: msg,
         background: color,
     })
 }
