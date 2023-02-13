$(document).ready(function(){
    $(".box").mouseenter(function(){
            $(this).css("box-shadow", "0px 12px 22px 1px #592a61");
        }).mouseleave(function(){
            $(this).css("box-shadow", "0 .3rem 5rem rgba(0, 0 , 0, .2)");
        });
});