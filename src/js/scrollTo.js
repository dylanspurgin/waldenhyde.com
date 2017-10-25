(function() {
    const $scrollToMenuItems = jQuery('.js-scrollToWrapper a[href*=#]');

    // Scroll to anchor menu items when clicked
    $scrollToMenuItems.click(function (e) {
        scrollToHash(e.target.hash);
    });

    // Smooth scroll to anchors on page load
    scrollToHash();

    function scrollToHash (hash) {
        hash = hash || window.location.hash;
        if (hash.length) {
            var $target = jQuery(hash.toLowerCase());
            jQuery('html,body').animate({
                scrollTop: $target.offset().top
            }, {
                duration: 600
            });
        }
    }

})();
