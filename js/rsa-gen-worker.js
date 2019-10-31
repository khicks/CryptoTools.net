onmessage = function(oEvent) {
    importScripts("JSEncrypt/jsencrypt-worker.min.js");

    let keySize = oEvent.data;

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