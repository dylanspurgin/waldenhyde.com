(function () {
    const $portfolioItems = jQuery('.js-portfolioItemWaypoint');
    const hoverClass = 'hover';

    $portfolioItems.each(function (index, el) {
        new Waypoint({
            element: el,
            handler: function (direction) {
                if (Waypoint.viewportWidth() <= 690) {
                    $portfolioItems.removeClass(hoverClass)
                    jQuery(el).addClass(hoverClass)
                }
            },
            offset: 'bottom-in-view'
        })
    })



})();
