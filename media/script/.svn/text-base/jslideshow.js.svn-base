$(function() {
    $('#pause').click(function() { $('#slides').cycle('pause'); return false; });
    $('#play').click(function() { $('#slides').cycle('resume'); return false; });

    $('#slideshow').hover(
        function() { $('#controls').fadeIn(); },
        function() { $('#controls').fadeOut(); }
    );

    $('#slides').cycle({
        fx:     'fade',
        speed:   400,
        timeout: 3000,
        next:   '#next',
        prev:   '#prev'
    });
});
