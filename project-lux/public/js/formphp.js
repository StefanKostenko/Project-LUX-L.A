$( function() {
    $( "#datepicker" ).datepicker();
  } );
  

$(document).ready(function(){
    $("#formularioEntradas").submit(function(e){
        e.preventDefault();
        let dateValue = 
        $.post("../formulario.php", {})
    })
})