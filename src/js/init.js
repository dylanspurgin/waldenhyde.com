console.debug('init.js');
(function() {
    var myElement = document.querySelector("header");
    var headroom = new Headroom(myElement);
    headroom.init();
})();
