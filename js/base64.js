$(function() {
    var plain = $("#plain");
    var base64 = $("#base64");
    var image = $("#image");

    plain.bind('input propertychange', function() {
        try {
            base64.val(btoa(plain.val()));
            //base64.val(window.btoa(escape(encodeURIComponent(plain.val()))));
        }
        catch(err) {
            base64.val("");
        }

        try {
            image.attr('src', "data:image/png;base64,"+base64.val());
        }
        catch (err) {
            image.hide();
        }
    });

    base64.bind('input propertychange', function() {
        try {
            plain.val(atob(base64.val()));
            //plain.val(decodeURIComponent(unescape(window.atob(base64.val()))));
        }
        catch(err) {
            plain.val("");
        }

        try {
            image.attr('src', "data:image/png;base64,"+base64.val());
        }
        catch (err) {
            image.hide();
        }
    });

    image.on('load', function() {
        image.show();
    }).on('error', function() {
        image.hide();
    });
});