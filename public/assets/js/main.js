$(function () {
    /*$('.play-card').click(function (e) {
        e.preventDefault()
        var video = $(this).closest('.video-card').find('video');
        src = video[0].src;
        div = $(this).closest('.video');
        div.html('');
        /!*if (video[0].paused) {
            video[0].play();
        }
        else {
            video[0].pause();
        }*!/
       /!* $(event.currentTarget).children('i').toggleClass('icon-pause');
        $(event.currentTarget).children('i').toggleClass('icon-play');
        $(video).on('ended',function(){
            $(event.currentTarget).parents('.video-card').find('button i').removeClass('icon-pause');
            $(event.currentTarget).parents('.video-card').find('button i').addClass('icon-play');
        });*!/
    });*/
    /*$('#search-icon').click(function () {
        $(this).parents('.nav').find('.search-page').toggle();
        $('.video-section').toggleClass('open');

    });*/
    var galleryTop = new Swiper('.gallery-top', {
        observeParents: true,
        spaceBetween: 5
    });

    galleryTop.on('slideChange', function () {
        //player.pauseVideo();
        for(i = 0; i < videos.length; ++i){
            videos[i].pauseVideo()
        }
        //videos[galleryTop.activeIndex].playVideo()

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
    $('.search-form button').click(function (e) {
        if ($('.search-form input').css('display') == 'none') {
            e.preventDefault();
        } else if ($('.search-form input').val() == '') {
            e.preventDefault();
        }
        $('.search-form input').toggle();
    })

    var resizeId;
    $(window).resize(function() {
        clearTimeout(resizeId);
        resizeId = setTimeout(doneResizing, 250);
    });

    function doneResizing(){
        if ($(window).width() > 768) {
            $('.menu-responsive').hide();
            $(this).find('i').removeClass('icon-close');
            $('section:not(:first-of-type)').show();
            $('section:first-of-type > .container').show();
            $('.video-section').removeClass('menu-open');
            $('footer').show();
        }
    }
});