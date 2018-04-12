(function() {
    var $scrollToMenuItems = jQuery('.js-scrollToWrapper a[href*=#]');

    // Scroll to anchor menu items when clicked
    $scrollToMenuItems.click(function (e) {
        scrollToHash(e.target.hash);
    });

    // Smooth scroll to anchors on page load
    scrollToHash();

    function scrollToHash (hash) {
        hash = hash || window.location.hash;
        console.debug('hash',hash);
        if (hash.length) {
            var $target = jQuery(hash.toLowerCase());
            if ($target.length) {
                jQuery('html,body').animate({
                    scrollTop: $target.offset().top
                }, {
                    duration: 600
                });
            }
        }
    }

})();
