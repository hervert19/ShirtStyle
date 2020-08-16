 $(document).ready(function () {
     $('.sidenav').sidenav();
     $('.carousel').carousel();
     $('.materialboxed').materialbox();
     $('select').formSelect();
     $('.collapsible').collapsible();
     $('.tooltipped').tooltip();
     $('.fixed-action-btn').floatingActionButton();
 });

 var objetoslider = document.getElementById('test-slider');
 noUiSlider.create(objetoslider, {
     start: [100, 1000],
     connect: true,
     range: {
         'min': 100,
         'max': 1000
     }
 });

 var max = document.getElementById('input-max');
 var min = document.getElementById('input-min');
 objetoslider.noUiSlider.on('update', function (values, handle) {
     var value = values[handle];
     if (handle) {
         max.value = value;
     } else {
         min.value = value;
     }
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
