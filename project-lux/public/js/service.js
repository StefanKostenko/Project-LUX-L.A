function resaltar(){
    this.style.height = "15rem";
    this.style.width=  "20rem";
    this.style.boxShadow= "0px 12px 22px 1px #592a61";
}

function reset(){
    this.style.height = "11rem";
    this.style.width=  "17rem";
    this.style.boxShadow = "0 .3rem 5rem rgba(0, 0 , 0, .2)";
}

window.onload = function(){
    var elementos = document.getElementsByClassName("box");
    for(var i=0; i < elementos.length; i++){
        elementos[i].addEventListener("mouseover", resaltar);
        elementos[i].addEventListener("mouseout", reset);
    }

}
