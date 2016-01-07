$(document).ready(function () {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50){
            $("#header").addClass("minifed");
        } else {
            $("#header").removeClass("minifed");
        }
    });
});