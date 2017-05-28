$(window).on("load resize", function () {
    $('#wrapper').css('padding-top', (window.innerWidth >= 768) ? parseInt($('#navbar').css("height")) : "50px");
}).resize();