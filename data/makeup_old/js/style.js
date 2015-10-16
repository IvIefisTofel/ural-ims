/* Variables */
var AnimEnd = 'animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd';
var nav = $('.nav');
var navButton = $('.nav-el');
var overlay = $('.overlay');
var $currentSlide;
var jScroll = {
    elements: [
        $('.gallery-container'),
        $('.main-container')
    ],
    options: {
        size: '10px',
        height: 'auto',
        alwaysVisible: true,
        borderRadius: 0
    }
};

var autoSlideId = 0,
    defaultInterval = 15000;

var galleryTheme = {
    wood: {
        theme: 'technics',
        loaded: false,
        arrImages: [],
        length: 0
    },
    machining: {
        theme: 'city',
        loaded: false,
        arrImages: [],
        length: 0
    },
    bucket: {
        theme: 'sports',
        loaded: false,
        arrImages: [],
        length: 0
    },
    countImages: 10,
    loading: false
};

/* Полезная штука, но тут пока не используется */
$.preloadImages = function () {
    if (typeof arguments[arguments.length - 1] == 'function') {
        var callback = arguments[arguments.length - 1];
    } else {
        var callback = false;
    }
    if (typeof arguments[0] == 'object') {
        var images = arguments[0];
        var n = images.length;
    } else {
        var images = arguments;
        var n = images.length - 1;
    }
    var not_loaded = n;
    for (var i = 0; i < n; i++) {
        if (typeof images[i] === 'undefined')
            not_loaded--;
        jQuery(new Image()).attr('src', images[i]).load(function() {
            if (--not_loaded < 1 && typeof callback == 'function') {
                callback();
            }
        });
    }
};

/**
 * Get random number between min and max
 * @param min
 * @param max
 * @return int
 */
function getRandom(min, max) {
    return ~~(Math.random() * (max - min) + min);
}

/**
 * Loading and parse gallery (now from placehold generator service)
 * @param index
 * @param [randomCount = false]
 * @returns {boolean}
 */
function loadGallery(index){
    if (!(typeof galleryTheme[index] === 'undefined') && !galleryTheme[index].loaded && !galleryTheme.loading) {
        galleryTheme.loading = true;

        $('#' + index + ' .preloader').fadeIn('slow');

        for (var i = 0; i < galleryTheme.countImages; i++) {
            galleryTheme[index]['arrImages'][i] = [];
            galleryTheme[index]['arrImages'][i]['index'] = i + 1;
            galleryTheme[index]['arrImages'][i]['src'] = [];
            galleryTheme[index]['arrImages'][i]['src']['min'] =
                'http://lorempixel.com/300/300/' + galleryTheme[index]['theme'] + '/' +
                galleryTheme[index]['arrImages'][i]['index'];
            galleryTheme[index]['arrImages'][i]['src']['original'] =
                'http://lorempixel.com/1280/720/' + galleryTheme[index]['theme'] + '/' +
                galleryTheme[index]['arrImages'][i]['index'];
        }
        galleryTheme[index]['arrImages'].sort(function(){
            return Math.random() - 0.6;
        });

        var blockHTML = '<div class="gallery-item" style="display: none"><img src="{min}" class="galleryImage" rel="{rel}" data-glisse-big="{original}"></div>';
        var currHTML;
        for (var i = 0; i < galleryTheme.countImages; i++) {
            currHTML = blockHTML.replace('{min}', galleryTheme[index]['arrImages'][i]['src']['min']);
            currHTML = currHTML.replace('{original}', galleryTheme[index]['arrImages'][i]['src']['original']);
            currHTML = currHTML.replace('{rel}', index);

            $('#' + index + ' .gallery').append(currHTML);
            $('#' + index + ' .gallery').children().last().find('img').load(function(){
                galleryTheme[index].length++
                $(this).parent().fadeIn('slow');
                if (galleryTheme[index].length == galleryTheme.countImages) {
                    /* Resize scrollBar */
                    jScrollInit();
                    ///* Reinit gallery */
                    $('.galleryImage').glisse({speed: 500, changeSpeed: 600});
                    /* Hide preloader */
                    $('#' + index + ' .preloader').fadeOut('slow');
                    /* Setup gallery as loaded */
                    galleryTheme[index].loaded = true;
                    galleryTheme.loading = false;
                }
            });
        }
    } else
        return false;
};

function jScrollInit() {
    $(jScroll.elements).each(function(){
        $(this).slimScroll(jScroll.options);
    });
}

/* Auto slide */
function autoSlide(interval){
    autoSlideId = setInterval(function() {
        $('#moveNext').click();
    }, interval);
}

function sliderOrientation() {
    var $el = $('.slider-content img');
    if ($("html").width() >= $("html").height()) {
        $el.removeAttr('style');
        $el.css('width', '100%');
    } else {
        $el.removeAttr('style');
        $el.css('height', '100%');
    }
}

$(document).ready(function () {
    /* Preloader generator */
    var countBloks = 8;
    var tempBlock = '<div class="slider-content-page imageWrapper">{image}</div>';
    var photoIndex, imageHTML, tmpHTML, $firstElement, countLoaded = 0;

    /* Loading random images for slider */
    for (var i = 0; i < countBloks; i++) {
        photoIndex = getRandom(1, 10);
        //photoIndex = i + 1;
        imageHTML = 'http://lorempixel.com/' + screen.width + '/' + screen.height + '/business/' + photoIndex;
        tmpHTML = tempBlock.replace('{image}', '<img id="' + i + '" photoIndex="' + photoIndex + '" src="' + imageHTML + '">');

        $('.slider-content').append(tmpHTML);
        $('.slider-content').children().last().find('img').load(function(){
            countLoaded++;
            if (countLoaded == countBloks) {
                $('.slider-content').children().first().css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0}, 'slow', function(){
                    /* initTransitions */
                    PageTransitions.init();
                    /* Start auto sliding */
                    autoSlide(defaultInterval);
                    $('.slider-content').children().first().removeAttr('style');
                });
            }
        });
        switch (i) {
            case 0:
                $firstElement = $('.slider-content').children().first();
                break;
            case 1:
                $('#moveNext img').attr('src', 'http://lorempixel.com/100/100/business/' + photoIndex);
                break;
            case countBloks - 1:
                $('#movePrev img').attr('src', 'http://lorempixel.com/100/100/business/' + photoIndex);
                break;
            default:
                break;
        }
    }

    /* Hide some elements */
    var elementsToHide = [
        $('.close'),
        $('.wrap-main'),
        $('.wrap-gallery'),
        $('.overlay button'),
        $('.preloader')
    ];
    $(elementsToHide).each(function(){
        $(this).hide();
    });

    /* Glisse gallery init */
    $('.galleryImage').glisse({speed: 500, changeSpeed: 600});

    /* On menu button click event */
    $(navButton).click(function(event){
        if ($(this).hasClass("inactive")) {
            event.preventDefault();
        } else {
            /* Stop auto sliding */
            clearInterval(autoSlideId);

            var dataId = $(this).attr('data-id');
            setTimeout(function(){
                /* Show buttons */
                $('.overlay.active').find('button').fadeIn('slow');

                /* Stop animation */
                $currentSlide = $('.slider-content-page.current').removeClass('current');
                /* Disable menu */
                $('.nav button.nav-el').attr({disabled: 'disabled'});

                /* Show overlay content */
                if ($('.overlay.active').find('.contact-us').length > 0) {
                    /* Main contacts slide up */
                    $('.main-contacts-footer').addClass('active');

                    $('.contact-us').fadeIn('slow');
                } else {
                    $('.wrap-gallery, .wrap-main').slideDown('slow', function(){
                        loadGallery(dataId);
                    });
                }
            },1500);

            /* Remove old previous classes */
            $(navButton).removeClass('inactive_reverse active_reverse');
            $(nav).removeClass('fx-box_rotate fx-box_rotate_reverse');
            $(overlay).removeClass('active active_reverse');

            /* Hide title */
            $(this).find('.title').addClass('hidden');

            /* Add classes on defined elements */
            $(this).siblings().addClass('inactive');
            $(this).addClass('active');
            $(nav).addClass('fx-box_rotate');

            /* Activate related overlay */
            var o_target = $(this).data('id');
            $('#'+o_target).addClass('active');

            /* Prevent scrolling */
            $("body").addClass('noscroll');

            /* slimScroll init */
            jScrollInit();
        }
    });

    /* On close button click event */
    $(".close").click(function(){
        $(this).parent().find('button').fadeOut('slow');

        /* Hide overlay content */
        if ($('.overlay.active').find('.contact-us').length > 0) {
            $('.contact-us').fadeOut('slow');
            /* Contacts slide-down */
            $('.main-contacts-footer').removeClass('active');
        } else {
            $('.wrap-gallery, .wrap-main').slideUp('slow');
        }

        /* Start animation */
        $currentSlide.addClass('current');

        /* Add *_reverse classes */
        $('.active', nav).removeClass('active').addClass('active_reverse');
        $('.inactive', nav).addClass('inactive_reverse');
        $(nav).addClass('fx-box_rotate_reverse');
        $(this).parent().addClass('active_reverse');

        /* Remove .noscroll and .inactive when animation is finished */
        $('.inactive_reverse').bind(AnimEnd, function(){

            $('body').removeClass('noscroll');
            $(navButton).removeClass('inactive');
            $('.inactive_reverse').unbind(AnimEnd);

            /* Show title */
            $(navButton).find('.title.hidden').removeClass('hidden');
            /* Start auto sliding */
            autoSlide(defaultInterval);
            /* Enable menu */
            $('.nav button.nav-el').removeAttr('disabled');
        });
    });

    /* Creative Form init */
    if (!String.prototype.trim) {
        (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
                return this.replace(rtrim, '');
            };
        })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
        // in case the input is already filled..
        if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
        }

        // events:
        inputEl.addEventListener( 'focus', onInputFocus );
        inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
        classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
        if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
        }
    }
    /* Creative Form end init */

    sliderOrientation();

    $(window).resize(function() {
        /* jScrollPane resize */
        if ($('.gallery-container .gallery').is(':visible')) {
            jScrollInit();
        }
        sliderOrientation();
    });

    /* on KeyUp */
    $(document).keyup(function(e) {
        if (e.keyCode == 27 && !$('#glisse-wrapper').is(':visible') && $('.overlay.active').find('.close').is(':visible')) {
            $('.overlay.active').find('.close').click();
        }
    });

    $('.home-menu .nav-el').css({'max-width': $(document).width(), 'max-height': $(document).height()});

    /* ckEditor */
    CKEDITOR.config.skin = 'office2013';
    //CKEDITOR.config.resize_minWidth = '550px';
    CKEDITOR.config.resize_dir = 'both';
    CKEDITOR.replace( 'ckEditor', {
        width: 550,
        height: 100,
        resize_dir: 'both',
        resize_minWidth: 550,
        resize_maxWidth: 1600,
        resize_minHeight: 200,
        resize_maxHeight: 490
    } );
});