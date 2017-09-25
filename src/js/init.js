(function() {
    const fadeIn = 'animated fadeIn';
    const fadeOut = 'animated fadeOut';
    const headerUpClass = 'menu-up';
    const headerDownClass = 'menu-down';
    const animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    const $header = jQuery('.js-headerWrapper');
    const $navToggle = jQuery('.js-navToggle');
    const $navFlout = jQuery('.js-navFlyout');
    const $scrollToMenuItems = jQuery('.js-scrollToWrapper a[href*=#]');
    const $flyoutMenuItems = jQuery('.js-navFlyout a[href*="#"]');
    const $homeMoreLink = jQuery('.js-homeMoreLinkWrapper');

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


    // Scroll to anchor menu items when clicked
    $scrollToMenuItems.click(function (e) {
        scrollToHash(e.target.hash);
    });

    // Hide flyout menu when nav item clicked
    $flyoutMenuItems.click(function () {
        $navToggle.prop('checked', !$navToggle.prop('checked')).trigger('change');
    });

    // Smooth scroll to anchors on page load
    scrollToHash();

    initMobileHeader();

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

    function initMobileHeader () {
        var minumumScrollTop = 100;
        var menuDelay = 300;
        var lastScrollTop = 0;
        var headerUpTimeout, headerDownTimeout;
        jQuery(window, document).scroll(function(event){

            var windowWidth = jQuery(window).width();
            if (windowWidth > 690) {
                return;
            }

            var st = jQuery(this).scrollTop();
            if (st > minumumScrollTop && st > lastScrollTop){
                // User scrolled down
                clearTimeout(headerDownTimeout);
                headerDownTimeout = false;
                if (!headerUpTimeout) {
                    headerUpTimeout = setTimeout(function () {
                        headerUpTimeout = false;
                        $header.removeClass(headerDownClass).addClass(headerUpClass);
                    }, menuDelay);
                }
            } else {
                // User scrolled up
                clearTimeout(headerUpTimeout);
                headerUpTimeout = false;
                if (!headerDownTimeout) {
                    headerDownTimeout = setTimeout(function () {
                        headerDownTimeout = false;
                        $header.removeClass(headerUpClass).addClass(headerDownClass);
                    }, menuDelay);
                }
            }
            lastScrollTop = st;
        });
    }

})();
