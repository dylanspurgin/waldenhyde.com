(function() {
    const fadeIn = 'animated fadeIn';
    const fadeOut = 'animated fadeOut';
    const animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    const $navToggle = jQuery('.js-navToggle');
    const $navFlout = jQuery('.js-navFlyout');
    const $flyoutMenuItems = jQuery('.js-navFlyout a[href*="#"]');
    const $showMenuIcon = jQuery('.js-navToggleIconShow');
    const $hideMenuIcon = jQuery('.js-navToggleIconHide');

    // Flyout menu
    $navToggle.on('change', function (e) {
        const checked = jQuery(this).prop('checked');
        if (checked) {
            showMenu();
        } else {
            hideMenu();
        }
    });

    // Hide flyout menu when nav item clicked
    $flyoutMenuItems.click(function () {
        $navToggle.prop('checked', !$navToggle.prop('checked')).trigger('change');
    });

    function showMenu () {
        $navFlout.css({'visibility': 'initial'});
        $navFlout.removeClass(fadeOut).addClass(fadeIn);
        $showMenuIcon.hide();
        $hideMenuIcon.show();
    }

    function hideMenu () {
        $navFlout.one(animationEnd, function() {
            $navFlout.css({'visibility': 'hidden'});
            $navFlout.off(animationEnd);
        });
        $navFlout.removeClass(fadeIn).addClass(fadeOut);
        $showMenuIcon.show();
        $hideMenuIcon.hide();
    }

})();
