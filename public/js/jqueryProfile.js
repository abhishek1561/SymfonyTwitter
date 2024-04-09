$(document).ready(function(){
    $("#btn2").click(function(){
        $("div").removeClass("box");
    })
    $("#btn3").click(function(){
        $("div").toggleClass("box");
    })
})