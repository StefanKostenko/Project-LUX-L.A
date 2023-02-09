window.onload = function(){
    document.getElementById("form").onsubmit = error;
}

function error(event) {

    var nombreFormulario = document.getElementById("name");
    var directionFormulario = document.getElementById("direction");
    var emailFormulario = document.getElementById("email");
    var passwordFormulario = document.getElementById("password");

    if (emailFormulario.value == "" || passwordFormulario.value == "" || nombreFormulario.value == "" || directionFormulario.value == "") {
        alert("Introduzca los datos");
        event.preventDefault();
    }else
    {
        this.submit;
    }
}