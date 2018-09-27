$(function () {
    $(document).on('click', '.play-card', function (event) {
        id = $(this).attr('id').split('-')[1]
        var video = $('#video-'+id);
        if (video[0].paused) {
            video[0].play();
        }
        else {
            video[0].pause();
        }
        $(event.currentTarget).children('i').toggleClass('icon-pause');
        $(event.currentTarget).children('i').toggleClass('icon-play');
        $(video).on('ended', function () {
            $(event.currentTarget).parents('.video-card').find('button i').removeClass('icon-pause');
            $(event.currentTarget).parents('.video-card').find('button i').addClass('icon-play');
        });
    });
});