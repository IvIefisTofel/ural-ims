/* Variables */
var AnimEnd = 'animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd';
var nav = $('.nav');
var navButton = $('.nav-el');
var overlay = $('.overlay');

var autoSlideId = 0,
    defaultInterval = 15000;

var loadedGallerys = {
    'ov-topleft':    false, // first
    'ov-topright':   false, // second
    'ov-btmleft':    false  // third
};
var galleryTheme = {
    'first': {
        'id': 'ov-topleft',
        'theme': 'technics',
        'type': 'wood',
        'arrImages': []
    },
    'secont': {
        'id': 'ov-topright',
        'theme': 'city',
        'type': 'machining',
        'arrImages': []
    },
    'third': {
        'id': 'ov-btmleft',
        'theme': 'sports',
        'type': 'bucket',
        'arrImages': []
    }
};
var loading = false;

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
 *
 * @param index
 * @param [randomCount = false]
 * @returns {boolean}
 */
function loadGallery(index){
    if (!(typeof loadedGallerys[index] === 'undefined') && !loadedGallerys[index] && !loading) {
        loading = true;

        $('#' + index + ' .preloader').fadeIn('slow');
        var count = 10,
            arrUrls = {
                'm': [],
                'o': []
            };
        var selector;
        switch (index) {
            case galleryTheme['first']['id']:
                selector = 'first';
                break;
            case galleryTheme['secont']['id']:
                selector = 'secont';
                break;
            case galleryTheme['third']['id']:
                selector = 'third';
                break;
            default:
                break;
        }

        for (var i = 0; i < count; i++) {
            galleryTheme[selector]['arrImages'][i] = [];
            galleryTheme[selector]['arrImages'][i]['index'] = i + 1;
            galleryTheme[selector]['arrImages'][i]['src'] = [];
            galleryTheme[selector]['arrImages'][i]['src']['min'] =
                'http://lorempixel.com/300/300/' + galleryTheme[selector]['theme'] + '/' +
                galleryTheme[selector]['arrImages'][i]['index'];
            galleryTheme[selector]['arrImages'][i]['src']['original'] =
                'http://lorempixel.com/1280/720/' + galleryTheme[selector]['theme'] + '/' +
                galleryTheme[selector]['arrImages'][i]['index'];
            arrUrls['m'][galleryTheme[selector]['arrImages'][i]['index']] = galleryTheme[selector]['arrImages'][i]['src']['min'];
            arrUrls['o'][galleryTheme[selector]['arrImages'][i]['index']] = galleryTheme[selector]['arrImages'][i]['src']['original'];
        }
        galleryTheme['first']['arrImages'].sort(function(){
            return Math.random() - 0.6;
        });

        var blockHTML = '<div class="gallary-item" style="display: none"><img src="{min}" class="gallaryImage" rel="{rel}" data-glisse-big="{original}"></div>';
        var currHTML, countLoaded = 0;
        for (var i = 0; i < count; i++) {
            currHTML = blockHTML.replace('{min}', galleryTheme[selector]['arrImages'][i]['src']['min']);
            currHTML = currHTML.replace('{original}', galleryTheme[selector]['arrImages'][i]['src']['original']);
            currHTML = currHTML.replace('{rel}', galleryTheme[selector]['type']);

            $('#' + index + ' .gallary').append(currHTML);
            $('#' + index + ' .gallary').children().last().find('img').load(function(){
                countLoaded++
                $(this).parent().fadeIn('slow');
                if (countLoaded == count) {
                    /* Resize scrollBar */
                    $('.jScrollPane').jScrollPane();
                    ///* Reinit gallery */
                    $('.gallaryImage').glisse({speed: 500, changeSpeed: 600});
                    /* Hide preloader */
                    $('#' + index + ' .preloader').fadeOut('slow');
                    /* Setup gallery as loaded */
                    loadedGallerys[index] = true;
                    loading = false;
                }
            });
        }

        //arrUrls = $.merge(arrUrls['m'], arrUrls['o']);
        //$.preloadImages(arrUrls, function(){});
    } else
        return false;
};

/* Auto slide */
function autoSlide(interval){
    autoSlideId = setInterval(function() {
        $('#moveNext').click();
    }, interval);
}

/* Contacts animate */
function bindContacts (){
    $(".main-contacts .main-contacts-footer").hover(function(){
        $(".main-contacts").css("bottom","-320px");
    }, function(){
        $(".main-contacts").css("bottom","-465px");
    });
}

$(document).ready(function () {
    /* Preloader generator */
    var countBloks = 8;
    var tempBlock = '<div class="slider-content-page imageWrapper">{image}</div>';
    var photoIndex, imageHTML, tmpHTML, $firstElement, countLoaded = 0;

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
    $('.close').hide();
    $('.wrap-gallary').hide();
    $('.overlay button').hide();
    $('.preloader').hide();

    bindContacts();

    /* Glisse gallery */
    $('.gallaryImage').glisse({speed: 500, changeSpeed: 600});

    /* On menu button click event */
    var $currentSlide;
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

                /* Show gallery */
                $('.wrap-gallary').slideDown('slow', function(){
                    loadGallery(dataId);
                });

                /* Show contacts content */
                if ($('.overlay.active').find('.contact-us').length > 0)
                    $('.contact-us').fadeIn('fast');
            },1500)

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

            /* jScrollPane init */
            $('.overlay.active').find('.wrap-gallary').show();
            $('.overlay.active').find('.jScrollPane').jScrollPane();
            $('.overlay.active').find('.wrap-gallary').hide();
        }
    });
    /* On contacts click */
    $('#el-btmright').click(function() {
        $(".main-contacts .main-contacts-footer").unbind('mouseenter mouseleave');
        /* Contacts slide-up */
        setTimeout(function () {
            $(".main-contacts").css("bottom","-320px")
        }, 1000);
    });

    /* On close button click event */
    $(".close").click(function(){
        $(this).parent().find('button').fadeOut('slow');
        /* Hide Contacts content */
        if ($('.overlay.active').find('.contact-us').length > 0)
            $('.contact-us').fadeOut('fast');

        /* Contacts slide-down */
        $(".main-contacts").css("bottom","-465px");
        bindContacts();
        /* Hide gallery */
        $('.wrap-gallary').slideUp('slow');

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

    /* jScrollPane resize */
    $(window).resize(function() {
        if ($('.jScrollPane').is(':visible')) {
            $('.jScrollPane').jScrollPane();
        }
    });

    /* on KeyUp */
    $(document).keyup(function(e) {
        if (e.keyCode == 27 && $('.overlay.active').find('.close').is(':visible'))
            $('.overlay.active').find('.close').click();
    });

    /* ckEditor */
    CKEDITOR.config.skin = 'office2013';
    CKEDITOR.replace( 'ckEditor' );
});