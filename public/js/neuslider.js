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