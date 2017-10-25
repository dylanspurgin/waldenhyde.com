(function() {
    const headerUpClass = 'menu-up';
    const headerDownClass = 'menu-down';
    const $header = jQuery('.js-headerWrapper');

    initMobileHeader();

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
