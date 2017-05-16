$(document).ready(function() {
    $("#input").val(window.location.hash.substr(1));
    $("#input").bind('input propertychange', function() {
        outputHashes($(this).val());
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

    outputHashes($("#input").val());
});

function shaHash(method, value) {
    if (value == null) value = "";
    var hashObj = new jsSHA(method, "TEXT");
    hashObj.update(value);
    return hashObj.getHash("HEX");
}

function outputHashes(value) {
    $("#output-md5").val(CryptoJS.MD5(value));
    $("#output-sha1").val(shaHash("SHA-1", value));
    $("#output-sha224").val(shaHash("SHA-224", value));
    $("#output-sha256").val(shaHash("SHA-256", value));
    $("#output-sha384").val(shaHash("SHA-384", value));
    $("#output-sha512").val(shaHash("SHA-512", value));
    $("#output-sha3224").val(shaHash("SHA3-224", value));
    $("#output-sha3256").val(shaHash("SHA3-256", value));
    $("#output-sha3384").val(shaHash("SHA3-384", value));
    $("#output-sha3512").val(shaHash("SHA3-512", value));
    $("#output-ripemd160").val(CryptoJS.RIPEMD160(value));
}