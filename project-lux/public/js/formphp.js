$( function() {
    $( "#datepicker" ).datepicker();
  } );
  

$(document).ready(function(){
    $("#entrada_form").submit(function(e){
        e.preventDefault();
        alert("formulario enviado con exito!")
    })
})