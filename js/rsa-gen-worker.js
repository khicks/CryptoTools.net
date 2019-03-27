importScripts("JSEncrypt/jsencrypt-worker.min.js");

onmessage = function(oEvent) {
    var keySize = oEvent.data;

    postMessage({
        status: "starting",
        data: {
            keylength: keySize
        }
    });

    var crypt = new JSEncrypt({
        default_key_size: keySize
    });
    var key = crypt.getPrivateKey();

    postMessage({
        status: "success",
        data: {
            key: key
        }
    });

    close();
};