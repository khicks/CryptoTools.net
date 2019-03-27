$(function() {
    var numAddresses = $("#num-addresses");
    var generateButton = $("#generate-button");
    var privateKeysField = $("#private-keys");
    var addressesField = $("#addresses");

    function generateKey() {
        var privateKeys = "";
        var addresses = "";
        var count = parseInt(numAddresses.val());

        for (var i=0; i<count; i++) {
            var keyPair = bitcoin.ECPair.makeRandom();

            privateKeys += keyPair.toWIF();
            addresses += keyPair.getAddress();

            if (i < count-1) {
                privateKeys += "\n";
                addresses += "\n";
            }
        }

        privateKeysField.val(privateKeys);
        addressesField.val(addresses);
    }

    generateButton.click(function() {
        generateKey();
    });

    numAddresses.on("change paste keyup mouseup", function() {
        var num = parseInt(numAddresses.val());
        if (isNaN(num) || num < 1) {
            numAddresses.val(1);
        }
        else if (num > 100) {
            numAddresses.val(100);
        }

        privateKeysField.attr("rows", numAddresses.val());
        addressesField.attr("rows", numAddresses.val());
    });
});