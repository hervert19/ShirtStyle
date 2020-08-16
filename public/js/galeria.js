 $(document).ready(function () {
     $('.sidenav').sidenav();
     $('.carousel').carousel();
     $('.materialboxed').materialbox();
     $('select').formSelect();
     $('.collapsible').collapsible();
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
     $("#formtotal").val("$ " + total.toFixed(2));
 }
