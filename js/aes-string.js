$(function() {
    var encryptButton = $("#encrypt-button");
    var decryptButton = $("#decrypt-button");
    var plaintextField = $("#plaintext");
    var ciphertextField = $("#ciphertext");
    var keyField = $("#key");
    var showKeyButton = $("#show-key-button");
    var genKeyButton = $("#gen-key-button");

    encryptButton.on('click', function() {
        decryptButton.removeClass('btn-danger active');
        decryptButton.addClass('btn-default');
        encryptButton.removeClass('btn-default');
        encryptButton.addClass('btn-success active');
        ciphertextField.prop('readonly', 'readonly');
        ciphertextField.addClass('readonly');
        plaintextField.removeAttr('readonly');
        plaintextField.removeClass('readonly');
        genKeyButton.removeAttr('disabled');
        plaintextField.focus();
    });

    decryptButton.on('click', function() {
        encryptButton.removeClass('btn-success active');
        encryptButton.addClass('btn-default');
        decryptButton.removeClass('btn-default');
        decryptButton.addClass('btn-danger active');
        plaintextField.prop('readonly', 'readonly');
        plaintextField.addClass('readonly');
        ciphertextField.removeAttr('readonly');
        ciphertextField.removeClass('readonly');
        genKeyButton.prop('disabled', 'disabled');
        ciphertextField.focus();
    });

    plaintextField.bind('input propertychange', function() {
        encrypt();
    });

    ciphertextField.bind('input propertychange', function() {
        decrypt();
    }).bind('focus', function() {
        $(this).select();
    });

    keyField.bind('input propertychange', function() {
        encryptButton.hasClass("active") ? encrypt() : decrypt();
    });

    showKeyButton.tooltip({
        container: 'body',
        placement: 'top',
        title: "Show Key"
    }).bind('click', function() {
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
        var key = "";
        var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i=0; i<16; i++) key += characters.charAt(Math.floor(Math.random()*characters.length));

        keyField.val(key);
        keyField.attr('type', 'text');
        showKeyButton.addClass("active");
        encrypt();
    });

    function encrypt() {
        ciphertextField.val(CryptoJS.AES.encrypt(plaintextField.val(), keyField.val()));
    }

    function decrypt() {
        try {
            plaintextField.val(CryptoJS.AES.decrypt(ciphertextField.val(), keyField.val()).toString(CryptoJS.enc.Utf8));
        }
        catch(e) {
            plaintextField.val("");
        }
    }

    plaintextField.focus();
});
