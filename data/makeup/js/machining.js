$(document).ready(function(){
    /* Glisse gallery init */
    $('.galleryImage').glisse({speed: 500, changeSpeed: 600});

    /* on KeyUp */
    $(document).keyup(function(e) {
        if (e.keyCode == 27 && !$('#glisse-wrapper').is(':visible') && $('.overlay.active').find('.close').is(':visible')) {
            $('.overlay.active').find('.close').click();
        }
    });
});