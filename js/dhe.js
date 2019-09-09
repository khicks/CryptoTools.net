$(function() {
    const generateButton = $('#generate-button');
    const myPrivate = $('#my-private');
    const myPublic = $('#my-public');
    const partnerPrivate = $('#partner-private');
    const partnerPublic = $('#partner-public');
    const sharedKey = $('#shared-key');
    let myKey;

    $("input:text").focus(function() {
        $(this).select();
    }).on('input propertychange', function() {
        updateKeys();
    });

    function hexToBase64(str) {
        return btoa(String.fromCharCode.apply(null,
            str.replace(/\r|\n/g, "").replace(/([\da-fA-F]{2}) ?/g, "0x$1 ").replace(/ +$/, "").split(" "))
        );
    }

    function base64ToHex(str) {
        for (var i = 0, bin = atob(str.replace(/[ \r\n]+$/, "")), hex = []; i < bin.length; ++i) {
            let tmp = bin.charCodeAt(i).toString(16);
            if (tmp.length === 1) tmp = "0" + tmp;
            hex[hex.length] = tmp;
        }
        return hex.join(" ");
    }

    function generateMyKey() {
        myKey = ec.genKeyPair();
        myPrivate.val(hexToBase64(myKey.getPrivate().toString('hex')));
    }

    function updateKeys() {
        myKey = ec.keyFromPrivate(myPrivate.val());
        myPublic.val(hexToBase64(myKey.getPublic().encode('hex')));

        if (myPublic.val().length > 0 && partnerPublic.val().length > 0) {
            let partnerKey = ec.keyFromPublic(base64ToHex(partnerPublic.val()), 'hex');
            sharedKey.val(hexToBase64(myKey.derive(partnerKey.getPublic()).toString(16)));
        }
    }

    generateButton.on('click', function() {
        generateMyKey();
        updateKeys();
    });

    myPrivate.tooltip({
        container: 'body',
        placement: 'top',
        html: true,
        title: "Paste an existing private key here or click \"Generate\".<br>Do <i>not</i> share this with your partner."
    });

    myPublic.tooltip({
        container: 'body',
        placement: 'top',
        title: "Send your public key to your partner."
    });

    partnerPrivate.tooltip({
        container: 'body',
        placement: 'top',
        html: true,
        title: "Your partner should <i>not</i> share their private key with you.",
    });

    partnerPublic.tooltip({
        container: 'body',
        placement: 'top',
        title: "Paste your partner's public key here."
    });

    sharedKey.tooltip({
        container: 'body',
        placement: 'top',
        title: "This shared secret is private between you and your partner."
    });

    generateMyKey();
    updateKeys();
});
