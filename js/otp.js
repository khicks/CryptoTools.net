$(function() {
    function dec2hex(s) {
        return (s < 15.5 ? '0' : '') + Math.round(s).toString(16);
    }
    function hex2dec(s) {
        return parseInt(s, 16);
    }

    function base32ToHex(base32) {
        var base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
        var bits = "";
        var hex = "";

        for (var i = 0; i < base32.length; i++) {
            var val = base32chars.indexOf(base32.charAt(i).toUpperCase());
            if (val == -1) {
                return false;
            }
            bits += leftPad(val.toString(2), 5, '0');
        }

        for (i = 0; i+4 <= bits.length; i+=4) {
            var chunk = bits.substr(i, 4);
            hex = hex + parseInt(chunk, 2).toString(16) ;
        }
        return hex;
    }

    function leftPad(str, len, pad) {
        if (len + 1 >= str.length) {
            str = new Array(len + 1 - str.length).join(pad) + str;
        }
        return str;
    }

    function updateOtp() {
        var secretInput = $("#secret");
        var generateQRCode = $("#generateQRCode");
        var qrWrapper = $("#QRWrapper");
        var qrCode = $("#QRCode");
        var accountNameInput = $("#name");
        var issuerInput = $("#issuer");
        var otpCurrentOutput = $("#otpCurrent");
        var otpNextOutput = $("#otpNext");
        var secretHexOutput = $("#secretHex");
        var secretHexLength = $("#secretHexLength");
        var epochIterationOutput = $("#epochIteration");
        var hmacOutput = $("#hmac");

        var epoch = Math.round(new Date().getTime() / 1000.0);
        var otpCurrent = calculateOTP(secretInput.val(), epoch);
        var otpNext = calculateOTP(secretInput.val(), epoch+30);

        epochIterationOutput.val(otpCurrent.epochIteration);

        if (otpCurrent.success) {
            secretInput.parent().removeClass('has-error');

            secretHexOutput.val(otpCurrent.key);
            secretHexLength.text(otpCurrent.keyLength+" bits");
            hmacOutput.val(otpCurrent.hmac[0]+"|"+otpCurrent.hmac[1]+"|"+otpCurrent.hmac[2]);
            otpCurrentOutput.val(otpCurrent.otp);
            otpNextOutput.val(otpNext.otp);

            if (accountNameInput.val().length > 0) {
                $("#QRWrapper").html("");
                new QRCode(document.getElementById("QRWrapper"), "otpauth://totp/"+accountNameInput.val()+"?secret="+secretInput.val().replace(/\s+/g,'')+"&issuer="+issuerInput.val()+"&period=30");
                //qrCode.attr('src', "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=200x200&chld=M|0&cht=qr&chl=otpauth://totp/"+accountNameInput.val().replace(/\s/g,'%2520')+"%3Fsecret%3D"+secretInput.val().replace(/\s+/g,'')+"%26issuer%3D"+issuerInput.val().replace(/\s/g,'%2520')+"%26period%3D30");
                qrWrapper.slideDown();
            }
            else {
                qrWrapper.slideUp();
            }
        }
        else {
            secretInput.parent().addClass('has-error');

            secretHexOutput.val("");
            secretHexLength.text("invalid");
            hmacOutput.val("");
            otpCurrentOutput.val("");
            otpNextOutput.val("");

            qrWrapper.slideUp();
        }
    }

    function calculateOTP(secret, epoch) {
        var time = leftPad(dec2hex(Math.floor(epoch / 30)), 16, '0');
        try {
            secret = secret.replace(/\s/g,'');
            var key = base32ToHex(secret);
            var shaObj = new jsSHA("SHA-1", "HEX");
            shaObj.setHMACKey(key, "HEX");
            shaObj.update(time);
            var hmac = shaObj.getHMAC("HEX");
            var offset = hex2dec(hmac.substring(hmac.length - 1));
            var otp = (hex2dec(hmac.substr(offset * 2, 8)) & hex2dec('7fffffff')) + '';
            otp = (otp).substr(otp.length - 6, 6);
        }
        catch(err) {
            return {
                success: false,
                otp: null,
                key: null,
                keyLength: null,
                epoch: epoch,
                epochIteration: time,
                hmac: null
            };
        }

        return {
            success: true,
            otp: otp,
            key: key,
            keyLength: key.length * 4,
            epoch: epoch,
            epochIteration: time,
            hmac: [
                hmac.substr(0, offset * 2),
                hmac.substr(offset * 2, 8),
                hmac.substr(offset * 2 + 8, hmac.length - offset)
            ]
        }
    }

    function generateKey() {
        var keyChars = new Array(32);
        var base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
        var randomNumbers = new Uint32Array(32);
        window.crypto.getRandomValues(randomNumbers);

        for (var i=0; i<randomNumbers.length; i++) {
            keyChars[i] = base32chars.charAt(randomNumbers[i]%32);
        }

        $("#secret").val(keyChars.join("").match(/.{4}/g).join(" "));
    }

    function timer() {
        var epoch = Math.round(new Date().getTime() / 1000.0);
        var countDown = 30 - (epoch % 30);
        if (epoch % 30 == 0) updateOtp();
        $("#epoch").val(epoch);
        $('#updatingIn').text(countDown);

        let percentLeft = (countDown / 30) * 100;
        $('#update-bar').animate({
            width: percentLeft+"%"
        }, 300);

        if (countDown <= 7) {
            $('#update-bar').addClass('bg-danger').removeClass('bg-success');
            $('#otpCurrent').addClass('border-danger').removeClass('border-success');
        }
        else {
            $('#update-bar').addClass('bg-success').removeClass('bg-danger');
            $('#otpCurrent').addClass('border-success').removeClass('border-danger');
        }
    }

    if (window.location.hash.substr(1) === "") {
        generateKey();
    }
    else {

        $("#secret").val(window.location.hash.substr(1).split("").join("").match(/.{4}/g).join(" "));
    }

    updateOtp();
    timer();

    $("#secret").bind('input propertychange', function () {
        updateOtp();
    });
    $("#name").bind('input propertychange', function() {
        updateOtp();
    });
    $("#issuer").bind('input propertychange', function() {
        updateOtp();
    });
    $("#generateButton").click(function() {
        generateKey();
        updateOtp();
    });
    $("#generateQRCode").change(function() {
        updateOtp();
    });
    $("input.form-control").focus(function() {
        $(this).select();
    });

    setInterval(timer, 1000);
});
