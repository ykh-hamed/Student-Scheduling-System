$(document).ready(function () {
    var mainNav = $(".main-nav");
    mainNavScroll = "main-nav-scrolled";
    headerHeight = $('header').height();

    $(window).scroll(function () {
        if ($(this).scrollTop() > headerHeight) {
            mainNav.addClass(mainNavScroll);
        } else {
            mainNav.removeClass(mainNavScroll);
        }
    });

});