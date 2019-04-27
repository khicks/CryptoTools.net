$(function() {
    const generateButton = $('#generate-button');
    const myPrivate = $('#my-private');
    const myPublic = $('#my-public');
    const partnerPrivate = $('#partner-private');
    const partnerPublic = $('#partner-public');
    const sharedKey = $('#shared-key');
    let myKey;

    // let myKey = ec.genKeyPair();
    //
    // myPrivate.val(myKey.getPrivate().toString('hex'));
    // myPublic.val(myKey.getPublic().encode('hex'));

    $("input:text").focus(function() {
        $(this).select();
    }).on('input propertychange', function() {
        updateKeys();
    });

    function generateMyKey() {
        myKey = ec.genKeyPair();
        myPrivate.val(myKey.getPrivate().toString('hex'));
    }

    function updateKeys() {
        myKey = ec.keyFromPrivate(myPrivate.val());
        myPublic.val(myKey.getPublic().encode('hex'));

        if (myPublic.val().length > 0 && partnerPublic.val().length > 0) {
            let partnerKey = ec.keyFromPublic(partnerPublic.val(), 'hex');
            sharedKey.val(myKey.derive(partnerKey.getPublic()).toString(16));
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
