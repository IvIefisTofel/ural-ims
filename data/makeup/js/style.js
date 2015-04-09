$(document).ready(function(){
    // Snappish Function
    //if (window.location.hash && $('nav a[href="' + window.location.hash + '"]').length > 0) {
        //var $snappish = $('#wrapper').snappish({'currentSlideNum': $('nav a[href="' + window.location.hash + '"]').attr('data-slide-num')});
        //$('nav a[href="' + window.location.hash + '"]').addClass('active');
        //$('#wrapper div.snappish-slide:eq(' + $('nav a[href="' + window.location.hash + '"]').attr('data-slide-num') + ')').addClass('active');
    //}
    location.hash = '';
    $('nav a').attr('href', '#');
    $('nav a').first().addClass('active');
    $('#wrapper div.snappish-slide').first().addClass('active');

    var $snappish = $('#wrapper').snappish();

    $snappish.on('scrollbegin.snappish', function(e, data) {                            // On Scrolling
        data.toSlide.addClass('active');	                                            // Add Class( Active ) To Slides
        $('.ui-outer a').removeClass('active');	                                        // Remove Class( Active ) From Navigation
        $('.ui-outer a[data-slide-num="' + data.toSlideNum + '"]').addClass('active');  // Add Class( Active ) To Navigation From Where ScrollEnds
        if (data.slidesCount - 1 == data.toSlideNum) {
            $(".ui-contacts .ui-footer").unbind('mouseenter mouseleave');
            setTimeout(function(){
                $(".ui-contacts").css("bottom", "-320px");
            }, 500);
        } else if (data.slidesCount - 1 == data.fromSlideNum) {
            $(".ui-contacts .ui-footer").hover(function(){
                $(".ui-contacts").css("bottom","-320px");
            }, function(){
                $(".ui-contacts").css("bottom","-465px");
            });
            $(".ui-contacts").css("bottom", "-465px");
        }
    }).on('scrollend.snappish', function(e, data) {
        data.fromSlide.removeClass('active');                                           // On Scroll Ends Remove Class( Active )
    });

    $('.ui-outer a').on('click', function(e) {                                          // Navigation OnClick Event
        e.preventDefault();
        $snappish.trigger('scrollto.snappish', $(this).data('slide-num'));              // Scroll To Clicked data slide navigation
    });

    // ToolTip
    $(function () {
        $('.ui-nav').tooltip();
    });

    // Disable dragging an image
    $('img').on('dragstart', function(event) { event.preventDefault(); });

    // Carousel
    $('#pictures-carousel').slippry({
        // general elements & wrapper
        slippryWrapper: '<div class="sy-box pictures-slider">', // wrapper to wrap everything, including pager

        // options
        adaptiveHeight: false,                                  // height of the sliders adapts to current slide
        captions: false,                                        // Position: overlay, below, custom, false

        // pager
        pager: false,

        // controls
        controls: false,
        autoHover: false,

        // transitions
        transition: 'kenburns',                                 // fade, horizontal, kenburns, false
        kenZoom: 140,
        speed: 10000, // time the transition takes (ms)

        onSlideBefore: function (slide, old_index, new_index) {
            var header  = $('#pictures-carousel li:eq(' + new_index +  ')').attr('header');
            var content = $('#pictures-carousel li:eq(' + new_index +  ')').attr('content');
            var side = new_index % 2 == 0 ? 'left' : 'right';
            var posDif = '300';
            var slideTo = new_index % 2 == 0 ? posDif : '-' + posDif;
            var slideFrom = new_index % 2 == 0 ? '-' + posDif : posDif;

            if (old_index == new_index) {
                if (header) {
                    $('.slider-caption-wrap h3').html(header);
                    if (content)
                        $('.slider-caption-wrap div.ui-details p').html(content);
                }

                $('.slider-caption-wrap h3').show();
                if (content) {
                    $('.slider-caption-wrap div.ui-details').show();
                }
            }
            else {
                $('.ui-details').addClass('sub');
                $('.slider-caption-wrap div.ui-details').animate({opacity: 0, left: slideTo}, 'slow', function(){
                    $('.slider-caption-wrap h3').animate({opacity: 0, left: slideTo}, 'slow', function(){
                        $('.slider-caption-wrap').removeClass('caption-left').removeClass('caption-right');
                        $('.slider-caption-wrap').addClass('caption-' + side);

                        $('.slider-caption-wrap h3').css('left', slideFrom);
                        $('.slider-caption-wrap div.ui-details').css('left', slideFrom);

                        if (header) {
                            $('.slider-caption-wrap h3').html(header);
                            $('.slider-caption-wrap h3').animate({opacity: 1, left: "0"}, 'slow', function(){
                                if (content) {
                                    $('.slider-caption-wrap p').html(content);
                                    $('.slider-caption-wrap div.ui-details').animate({opacity: 1, left: "0"}, 'slow', function(){
                                        $('.ui-details').removeClass('sub');
                                    })
                                }
                            });
                        }
                    });
                });
            }

            return this;
        }
    });

    // Yandex Maps
    ymaps.ready(init);
    var myMap, myPlacemark;

    function init(){
        // Создаем карту.
        var placemarkCoords = [56.87004338374307,53.17132911838527];
        var centerCoords = [placemarkCoords[0], placemarkCoords[1] + 0.01240253448487];
        //alert(placemarkCoords + "\n" + centerCoords);
        var myMap = new ymaps.Map("y-maps", {
            center: centerCoords,
            zoom: 16,
            controls: ['zoomControl', 'searchControl', 'fullscreenControl']
        });

        // Создаем метку.
        var myPlacemark = new ymaps.Placemark(placemarkCoords, {hintContent: 'Мы находимся здесь.'});

        myMap.events.add("click", function(e){
            var coords = e.get("coords");
            myPlacemark.geometry.setCoordinates(coords);
            $('.snappish-slide.active div h2').text(coords);
        });
        myMap.geoObjects.add(myPlacemark);
    }

    <!-- Hover effect JS -->
    $(function (){
        $(".ui-contacts .ui-footer").hover(function(){
            $(".ui-contacts").css("bottom","-320px");
        }, function(){
            $(".ui-contacts").css("bottom","-465px");
        });

        $('#y-maps').mouseenter(function(){
            $(this).parent().addClass('y-maps-hovered');
        });
        $('#y-maps').mouseleave(function(){
            $(this).parent().removeClass('y-maps-hovered');
        });
    });


});

/*$(window).load(function(){
    if (hash && $('nav a[href="' + hash + '"]').length > 0) {
        $('nav a[href="' + hash + '"]').click();
        location.hash = hash;
    }
});*/

// Animation
/*
$(document).ready(function(){
    // On Click
    $("a.ui-head").click(function(e){
        e.preventDefault();
        if(!($(this).parent(".ui-outer").hasClass("open"))){
            $(this).parent(".ui-outer").addClass("open").animate({"width": "180px"});   // Expands outer block
            $(this).parent(".ui-outer").find("a > span").animate({"opacity": "1"});     // Display Headings
        }
        else{
            $(this).parent(".ui-outer").removeClass("open").animate({"width": "45px"});	// Reduces outer block
            $(this).parent(".ui-outer").find("a > span").animate({"opacity": "0"});		// Hide Headings
        }
    });
});*/
