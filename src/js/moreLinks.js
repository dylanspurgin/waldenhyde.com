(function() {
    const $homeMoreLink = jQuery('.js-homeMoreLinkWrapper');
    const $hero = jQuery('.js-homeHero');



    // More link only shown on mobile
    if ($homeMoreLink.length && jQuery(window).width() > 690) {
        // Position to bottom of video
        var videoHeight = $hero.outerHeight();
        var viewportHeight = jQuery(window).height();
        var containerHeight = viewportHeight < videoHeight ? viewportHeight : videoHeight;
        $homeMoreLink.css({
            top: ($hero.offset().top + containerHeight - $homeMoreLink.outerHeight() - 20) + 'px',
        }).fadeIn(1000);
    }

    // Hide more link on click
    $homeMoreLink.click(function () {
        jQuery(this).fadeOut();
    });

    // Hide more link on scroll down
    jQuery(window, document).scroll(function () {
        var scrollTop = jQuery(this).scrollTop();
        if (scrollTop > 200) {
            $homeMoreLink.fadeOut();
        }
    });

    $homeMoreLink.click(function () {
        jQuery(this).fadeOut();
    });


})();
