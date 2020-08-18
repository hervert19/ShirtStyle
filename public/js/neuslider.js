  var defmin = document.getElementById('input-min').value;
  var defmax = document.getElementById('input-max').value;
  
 var objetoslider = document.getElementById('test-slider');
 noUiSlider.create(objetoslider, {
     start: [defmin, defmax],
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