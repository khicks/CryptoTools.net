$(document).ready(function() {
    let inputField = $("#input");
    let keyField = $("#key");
    let showKeyButton = $("#show-key-button");
    let genKeyButton = $("#gen-key-button");

    showKeyButton.tooltip({
        container: 'body',
        placement: 'top',
        title: "Show Key"
    }).on('click', function() {
        if (showKeyButton.hasClass("active")) {
            keyField.attr('type', 'password');
            showKeyButton.removeClass("active");
        }
        else {
            keyField.attr('type', 'text');
            showKeyButton.addClass("active");
        }
        keyField.focus();
    });

    genKeyButton.tooltip({
        container: 'body',
        placement:'top',
        title: "Generate Key"
    }).bind('click', function() {
        let key = "";
        const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (let i=0; i<32; i++) key += characters.charAt(Math.floor(Math.random()*characters.length));

        keyField.val(key);
        keyField.attr('type', 'text');
        showKeyButton.addClass("active");
        outputHashes(inputField.val(), keyField.val());
    });

    inputField.val(window.location.hash.substr(1));
    inputField.bind('input propertychange', function() {
        outputHashes($(this).val(), keyField.val());
    });

    keyField.bind('input propertychange', function() {
        outputHashes(inputField.val(), $(this).val())
    });

    $("input:text").focus(function() {
        $(this).select();
    }).mouseup(function(e) {
        e.preventDefault();
    }).keypress(function(e) {
        e.preventDefault();
    }).bind('cut paste', function(e) {
        e.preventDefault();
    });

    outputHashes(inputField.val(), keyField.val());
});

function shaHash(method, value, key) {
    if (value == null) value = "";
    let hmacObj = new jsSHA(method, "TEXT");
    hmacObj.setHMACKey(key,"TEXT");
    hmacObj.update(value);
    return hmacObj.getHMAC("HEX");
}

function outputHashes(value, key) {
    $("#output-md5").val(CryptoJS.HmacMD5(value, key));
    $("#output-sha1").val(shaHash("SHA-1", value, key));
    $("#output-sha224").val(shaHash("SHA-224", value, key));
    $("#output-sha256").val(shaHash("SHA-256", value, key));
    $("#output-sha384").val(shaHash("SHA-384", value, key));
    $("#output-sha512").val(shaHash("SHA-512", value, key));
    $("#output-sha3224").val(shaHash("SHA3-224", value, key));
    $("#output-sha3256").val(shaHash("SHA3-256", value, key));
    $("#output-sha3384").val(shaHash("SHA3-384", value, key));
    $("#output-sha3512").val(shaHash("SHA3-512", value, key));
    $("#output-ripemd160").val(CryptoJS.HmacRIPEMD160(value, key));
}