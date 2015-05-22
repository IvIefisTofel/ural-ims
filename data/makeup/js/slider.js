var PageTransitions = (function() {

	var $main = $('.slider-content'),
		$pages,
        pagesCount,
		//animcursor = 1,
        $navigation = $('nav.slider-nav a'),
		current = 0,
        next = 0,
		isAnimating = false,
		endCurrPage = false,
		endNextPage = false,
		animEndEventNames = {
			'WebkitAnimation' : 'webkitAnimationEnd',
			'OAnimation' : 'oAnimationEnd',
			'msAnimation' : 'MSAnimationEnd',
			'animation' : 'animationend'
		},
		// animation end event name
		animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
		// support css animations
		support = Modernizr.cssanimations;
	
	function init() {
        $pages = $main.children('div.slider-content-page');
        pagesCount = $pages.length;

		$pages.each( function() {
			var $page = $( this );
			$page.data( 'originalClassList', $page.attr( 'class' ) );
		} );

		$pages.eq( current ).addClass( 'current' );

        $navigation.click(function (event) {
            if ($(this).attr('disabled'))
                return false;

            event.preventDefault();
            $navigation.attr('disabled', 'disabled');

            var anim = $(this).attr('data-animation'),
                moveTo = $(this).attr('id');

            var newNext, photoIndex;
            switch (moveTo) {
                case 'movePrev':
                    if( current > 0 ) {
                        next = current - 1;
                    }
                    else {
                        next = pagesCount - 1;
                    }
                    if( next > 0 ) {
                        newNext = next - 1;
                    }
                    else {
                        newNext = pagesCount - 1;
                    }
                    break;
                default:
                    if( current < pagesCount - 1 ) {
                        next = current + 1;
                    }
                    else {
                        next = 0;
                    }
                    if( next < pagesCount - 1 ) {
                        newNext = next + 1;
                    }
                    else {
                        newNext = 0;
                    }
                    break;
            }
            var currentPhotoIndex = photoIndex = $('#' + current).attr('photoIndex');

            clearInterval(autoSlideId);
            $('nav.home-menu button').attr({disabled: 'disabled'});
            nextPage( parseInt(anim) );
            autoSlide(defaultInterval);
            $(this).find('img').fadeOut('slow', function(){
                switch (moveTo) {
                    case 'movePrev':
                        photoIndex = $('#' + newNext).attr('photoIndex');
                        $('#movePrev').find('img').attr('src', 'http://lorempixel.com/100/100/business/' + photoIndex).fadeIn('slow');
                        $('#moveNext').find('img').attr('src', 'http://lorempixel.com/100/100/business/' + currentPhotoIndex);

                        break;
                    default:
                        photoIndex = $('#' + newNext).attr('photoIndex');
                        $('#moveNext').find('img').attr('src', 'http://lorempixel.com/100/100/business/' + photoIndex).fadeIn('slow');
                        $('#movePrev').find('img').attr('src', 'http://lorempixel.com/100/100/business/' + currentPhotoIndex);

                        break;
                }
            });
        });

		/*$( '#dl-menu' ).dlmenu( {
			animationClasses : { in : 'dl-animate-in-2', out : 'dl-animate-out-2' },
			onLinkClick : function( el, ev ) {
				ev.preventDefault();
				nextPage( el.data( 'animation' ) );
			}
		} );*/

		/*$iterate.on( 'click', function() {
			if( isAnimating ) {
				return false;
			}
			if( animcursor > 67 ) {
				animcursor = 1;
			}
			nextPage( animcursor );
			++animcursor;
		} );*/


	}

	function nextPage( animation ) {

		if( isAnimating ) {
			return false;
		}

		isAnimating = true;
		
		var $currPage = $pages.eq( current );

		var $nextPage = $pages.eq( next ).addClass( 'current' ),
			outClass = '', inClass = '';

		switch( animation ) {

            case 1:
                outClass = 'page-moveToLeft';
                inClass = 'page-moveFromRight';
                break;
            case 2:
                outClass = 'page-moveToRight';
                inClass = 'page-moveFromLeft';
                break;
            case 3:
                outClass = 'page-moveToTop';
                inClass = 'page-moveFromBottom';
                break;
            case 4:
                outClass = 'page-moveToBottom';
                inClass = 'page-moveFromTop';
                break;
            case 5:
                outClass = 'page-fade';
                inClass = 'page-moveFromRight page-ontop';
                break;
            case 6:
                outClass = 'page-fade';
                inClass = 'page-moveFromLeft page-ontop';
                break;
            case 7:
                outClass = 'page-fade';
                inClass = 'page-moveFromBottom page-ontop';
                break;
            case 8:
                outClass = 'page-fade';
                inClass = 'page-moveFromTop page-ontop';
                break;
            case 9:
                outClass = 'page-moveToLeftFade';
                inClass = 'page-moveFromRightFade';
                break;
            case 10:
                outClass = 'page-moveToRightFade';
                inClass = 'page-moveFromLeftFade';
                break;
            case 11:
                outClass = 'page-moveToTopFade';
                inClass = 'page-moveFromBottomFade';
                break;
            case 12:
                outClass = 'page-moveToBottomFade';
                inClass = 'page-moveFromTopFade';
                break;
            case 13:
                outClass = 'page-moveToLeftEasing page-ontop';
                inClass = 'page-moveFromRight';
                break;
            case 14:
                outClass = 'page-moveToRightEasing page-ontop';
                inClass = 'page-moveFromLeft';
                break;
            case 15:
                outClass = 'page-moveToTopEasing page-ontop';
                inClass = 'page-moveFromBottom';
                break;
            case 16:
                outClass = 'page-moveToBottomEasing page-ontop';
                inClass = 'page-moveFromTop';
                break;
            case 17:
                outClass = 'page-scaleDown';
                inClass = 'page-moveFromRight page-ontop';
                break;
            case 18:
                outClass = 'page-scaleDown';
                inClass = 'page-moveFromLeft page-ontop';
                break;
            case 19:
                outClass = 'page-scaleDown';
                inClass = 'page-moveFromBottom page-ontop';
                break;
            case 20:
                outClass = 'page-scaleDown';
                inClass = 'page-moveFromTop page-ontop';
                break;
            case 21:
                outClass = 'page-scaleDown';
                inClass = 'page-scaleUpDown page-delay300';
                break;
            case 22:
                outClass = 'page-scaleDownUp';
                inClass = 'page-scaleUp page-delay300';
                break;
            case 23:
                outClass = 'page-moveToLeft page-ontop';
                inClass = 'page-scaleUp';
                break;
            case 24:
                outClass = 'page-moveToRight page-ontop';
                inClass = 'page-scaleUp';
                break;
            case 25:
                outClass = 'page-moveToTop page-ontop';
                inClass = 'page-scaleUp';
                break;
            case 26:
                outClass = 'page-moveToBottom page-ontop';
                inClass = 'page-scaleUp';
                break;
            case 27:
                outClass = 'page-scaleDownCenter';
                inClass = 'page-scaleUpCenter page-delay400';
                break;
            case 28:
                outClass = 'page-rotateRightSideFirst';
                inClass = 'page-moveFromRight page-delay200 page-ontop';
                break;
            case 29:
                outClass = 'page-rotateLeftSideFirst';
                inClass = 'page-moveFromLeft page-delay200 page-ontop';
                break;
            case 30:
                outClass = 'page-rotateTopSideFirst';
                inClass = 'page-moveFromTop page-delay200 page-ontop';
                break;
            case 31:
                outClass = 'page-rotateBottomSideFirst';
                inClass = 'page-moveFromBottom page-delay200 page-ontop';
                break;
            case 32:
                outClass = 'page-flipOutRight';
                inClass = 'page-flipInLeft page-delay500';
                break;
            case 33:
                outClass = 'page-flipOutLeft';
                inClass = 'page-flipInRight page-delay500';
                break;
            case 34:
                outClass = 'page-flipOutTop';
                inClass = 'page-flipInBottom page-delay500';
                break;
            case 35:
                outClass = 'page-flipOutBottom';
                inClass = 'page-flipInTop page-delay500';
                break;
            case 36:
                outClass = 'page-rotateFall page-ontop';
                inClass = 'page-scaleUp';
                break;
            case 37:
                outClass = 'page-rotateOutNewspaper';
                inClass = 'page-rotateInNewspaper page-delay500';
                break;
            case 38:
                outClass = 'page-rotatePushLeft';
                inClass = 'page-moveFromRight';
                break;
            case 39:
                outClass = 'page-rotatePushRight';
                inClass = 'page-moveFromLeft';
                break;
            case 40:
                outClass = 'page-rotatePushTop';
                inClass = 'page-moveFromBottom';
                break;
            case 41:
                outClass = 'page-rotatePushBottom';
                inClass = 'page-moveFromTop';
                break;
            case 42:
                outClass = 'page-rotatePushLeft';
                inClass = 'page-rotatePullRight page-delay180';
                break;
            case 43:
                outClass = 'page-rotatePushRight';
                inClass = 'page-rotatePullLeft page-delay180';
                break;
            case 44:
                outClass = 'page-rotatePushTop';
                inClass = 'page-rotatePullBottom page-delay180';
                break;
            case 45:
                outClass = 'page-rotatePushBottom';
                inClass = 'page-rotatePullTop page-delay180';
                break;
            case 46:
                outClass = 'page-rotateFoldLeft';
                inClass = 'page-moveFromRightFade';
                break;
            case 47:
                outClass = 'page-rotateFoldRight';
                inClass = 'page-moveFromLeftFade';
                break;
            case 48:
                outClass = 'page-rotateFoldTop';
                inClass = 'page-moveFromBottomFade';
                break;
            case 49:
                outClass = 'page-rotateFoldBottom';
                inClass = 'page-moveFromTopFade';
                break;
            case 50:
                outClass = 'page-moveToRightFade';
                inClass = 'page-rotateUnfoldLeft';
                break;
            case 51:
                outClass = 'page-moveToLeftFade';
                inClass = 'page-rotateUnfoldRight';
                break;
            case 52:
                outClass = 'page-moveToBottomFade';
                inClass = 'page-rotateUnfoldTop';
                break;
            case 53:
                outClass = 'page-moveToTopFade';
                inClass = 'page-rotateUnfoldBottom';
                break;
            case 54:
                outClass = 'page-rotateRoomLeftOut page-ontop';
                inClass = 'page-rotateRoomLeftIn';
                break;
            case 55:
                outClass = 'page-rotateRoomRightOut page-ontop';
                inClass = 'page-rotateRoomRightIn';
                break;
            case 56:
                outClass = 'page-rotateRoomTopOut page-ontop';
                inClass = 'page-rotateRoomTopIn';
                break;
            case 57:
                outClass = 'page-rotateRoomBottomOut page-ontop';
                inClass = 'page-rotateRoomBottomIn';
                break;
            case 58:
                outClass = 'page-rotateCubeLeftOut page-ontop';
                inClass = 'page-rotateCubeLeftIn';
                break;
            case 59:
                outClass = 'page-rotateCubeRightOut page-ontop';
                inClass = 'page-rotateCubeRightIn';
                break;
            case 60:
                outClass = 'page-rotateCubeTopOut page-ontop';
                inClass = 'page-rotateCubeTopIn';
                break;
            case 61:
                outClass = 'page-rotateCubeBottomOut page-ontop';
                inClass = 'page-rotateCubeBottomIn';
                break;
            case 62:
                outClass = 'page-rotateCarouselLeftOut page-ontop';
                inClass = 'page-rotateCarouselLeftIn';
                break;
            case 63:
                outClass = 'page-rotateCarouselRightOut page-ontop';
                inClass = 'page-rotateCarouselRightIn';
                break;
            case 64:
                outClass = 'page-rotateCarouselTopOut page-ontop';
                inClass = 'page-rotateCarouselTopIn';
                break;
            case 65:
                outClass = 'page-rotateCarouselBottomOut page-ontop';
                inClass = 'page-rotateCarouselBottomIn';
                break;
            case 66:
                outClass = 'page-rotateSidesOut';
                inClass = 'page-rotateSidesIn page-delay200';
                break;
            case 67:
                outClass = 'page-rotateSlideOut';
                inClass = 'page-rotateSlideIn';
                break;

		}

		$currPage.addClass( outClass ).on( animEndEventName, function() {
			$currPage.off( animEndEventName );
			endCurrPage = true;
			if( endNextPage ) {
				onEndAnimation( $currPage, $nextPage );
			}
		} );

		$nextPage.addClass( inClass ).on( animEndEventName, function() {
			$nextPage.off( animEndEventName );
			endNextPage = true;
			if( endCurrPage ) {
				onEndAnimation( $currPage, $nextPage );
			}
		} );

		if( !support ) {
			onEndAnimation( $currPage, $nextPage );
		}

	}

	function onEndAnimation( $outpage, $inpage ) {
		endCurrPage = false;
		endNextPage = false;
		resetPage( $outpage, $inpage );
		isAnimating = false;
        current = next;
        $navigation.removeAttr('disabled');
        $('nav.home-menu button').removeAttr('disabled');
	}

	function resetPage( $outpage, $inpage ) {
        $outpage.attr( 'class', $outpage.data( 'originalClassList' ) );
        $inpage.attr( 'class', $inpage.data( 'originalClassList' ) + ' current' );
	}

	//init();

	return { init : init };

})();