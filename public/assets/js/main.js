$(function () {
    var galleryTop = new Swiper('.gallery-top', {
        observeParents: true,
        spaceBetween: 5
    });

    galleryTop.on('slideChange', function () {
        for (i = 0; i < videos.length; ++i) {
            videos[i].pauseVideo()
        }

    });
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 20,
        slidesPerView: 3,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        observeParents: true,
        centeredSlides: true,
        navigation: {
            prevEl: '.swiper-button-next.swiper-button-white',
            nextEl: '.swiper-button-prev.swiper-button-white'
        },
        // breakpoints: {
        //     768: {
        //         slidesPerView: 3,
        //     }
        // },

    });
    /* connect thumbnail with main slider */
    if (typeof galleryTop.controller !== 'undefined') {
        galleryTop.controller.control = galleryThumbs;
        galleryThumbs.controller.control = galleryTop;
    }
    //responsive-menu
    $('.icon-bar').click(function () {
        $('.menu-responsive').toggle();
        $(this).find('i').toggleClass('icon-close');
        $('section:not(:first-of-type)').toggle();
        $('section:first-of-type > .container').toggle();
        $('.video-section').toggleClass('menu-open');
        $('footer').toggle();
    })

    $('.scroll a').click(function (e) {
        // Prevent a page reload when a link is pressed
        e.preventDefault();
        $('html,body').animate({
            scrollTop: $('section:nth-of-type(2)').offset().top
        }, 'slow');
    })

    var resizeId;
    $(window).resize(function () {
        clearTimeout(resizeId);
        resizeId = setTimeout(doneResizing, 250);
    });

    function doneResizing() {
        if ($(window).width() > 768) {
            $('.menu-responsive').hide();
            $(this).find('i').removeClass('icon-close');
            $('section:not(:first-of-type)').show();
            $('section:first-of-type > .container').show();
            $('.video-section').removeClass('menu-open');
            $('footer').show();
        }
    }

    $('.menu-responsive .items li:has(.sub-items)').click(function () {
        $(this).find('a').toggleClass('mb-25');
        $(this).find('.sub-items').toggle();
    });

//     scroll
    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };


    function updateCards() {
        $('.card').each(function () {
            if ($(this).isInViewport()) {
                $(this).css({
                    opacity: '1',
                    transform: 'translateY(-10px)'
                });
            }
        });
    }

    updateCards();

    $(window).on('resize scroll', function () {
        updateCards();

    });
});