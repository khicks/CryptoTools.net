$(function() {
    var generateButton = $("#generate-button");
    var keyLength = $("#key-length");
    var genModal = $("#gen-modal");
    var genProgressBar = $("#gen-progress-bar");
    var genSuccess = $("#gen-success");
    var genError = $("#gen-error");
    var privateKeyBox = $("#private-key");
    var publicKeyBox = $("#public-key");
    var keyBoxes = $(".key-box");

    var csrftoken = $('meta[name=csrftoken]').attr("content");
    var crypt = new JSEncrypt();

    privateKeyBox.bind('input propertychange', function() {
        try {
            crypt.setPrivateKey(privateKeyBox.val());
            publicKeyBox.val(crypt.getPublicKey());
        }
        catch(e) {
            publicKeyBox.val("");
        }
    });

    //select whole private/public key on click
    keyBoxes.focus(function() {
        $(this).select();
    });

    generateButton.click(function() {
        genModal.modal({
            keyboard: false,
            backdrop: "static",
            show: true
        });
    });

    genModal.on('show.bs.modal', function() {
        genProgressBar.addClass("progress-bar-striped progress-bar-animated").removeClass("bg-success");
    }).on('shown.bs.modal', function() {
        var genWorker = new Worker('js/rsa-gen-worker.js');
        genWorker.onmessage = function(oEvent) {
            if (oEvent.data.status == "success") {
                crypt.setPrivateKey(oEvent.data.data.key);
                privateKeyBox.val(crypt.getPrivateKey());
                publicKeyBox.val(crypt.getPublicKey());
                genSuccess.show();
                genProgressBar.addClass("bg-success").removeClass("progress-bar-striped progress-bar-animated");
                setTimeout(function() {
                    genModal.modal('hide');
                }, 1000);
            }
        };
        genWorker.onerror = function(oEvent) {
            genError.show();
            genProgressBar.removeClass("active");
            setTimeout(function() {
                genModal.modal('hide');
            }, 1000);
        };
        genWorker.postMessage(keyLength.val());
    }).on('hidden.bs.modal', function() {
        genSuccess.hide();
        genError.hide();
    });
});
