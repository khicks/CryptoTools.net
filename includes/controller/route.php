<?php

class CryptoToolsRoute {
    public static function page_home() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "Home",
            'include' => array(
                'js' => array(
                    'root' => array(
                        "home.js"
                    )
                )
            ),
            'navigation' => array(
                'home' => array(
                    'active' => true
                )
            )
        );
        $cryptotools->displayTemplate("home.html", $params);
    }

    public static function page_aes_string() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "AES String Encryption and Decryption",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "aes-string.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "CryptoJS/aes.js",
                        "aes-string.js"
                    )
                )
            ),
            'navigation' => array(
                'symmetric' => array(
                    'active' => true,
                    'items' => array(
                        'aes' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("aes-string.html", $params);
    }

    public static function page_rsa_gen() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "RSA Key Generator",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "rsa-gen.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "JSEncrypt/jsencrypt.min.js",
                        "rsa-gen.js"
                    )
                )
            ),
            'navigation' => array(
                'asymmetric' => array(
                    'active' => true,
                    'items' => array(
                        'rsagen' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("rsa-gen.html", $params);
    }

    public static function page_hash_string() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "String Hash Calculator",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "hash-string.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "CryptoJS/md5.js",
                        "CryptoJS/ripemd160.js",
                        "sha.js",
                        "hash-string.js"
                    )
                )
            ),
            'navigation' => array(
                'hashing' => array(
                    'active' => true,
                    'items' => array(
                        'hash_string' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("hash-string.html", $params);
    }

    public static function page_otp() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "One-Time Password Calculator",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "otp.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "qrcode.min.js",
                        "sha.js",
                        "otp.js"
                    )
                )
            ),
            'navigation' => array(
                'hashing' => array(
                    'active' => true,
                    'items' => array(
                        'otp' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("otp.html", $params);
    }

    public static function page_base64() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "Base64 Converter",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "base64.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "base64.js"
                    )
                )
            ),
            'navigation' => array(
                'other' => array(
                    'active' => true,
                    'items' => array(
                        'base64' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("base64.html", $params);
    }

    public static function page_bitcoin() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "Bitcoin Toolkit",
            'include' => array(
                'css' => array(
                    'root' => array(
                        "bitcoin-tools.css"
                    )
                ),
                'js' => array(
                    'root' => array(
                        "bitcoinjs.min.js",
                        "bitcoin-tools.js"
                    )
                )
            ),
            'navigation' => array(
                'other' => array(
                    'active' => true,
                    'items' => array(
                        'bitcoin-tools' => array(
                            'active' => true
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("bitcoin-tools.html", $params);
    }

    public static function page_about() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "About"
        );
        $cryptotools->displayTemplate("about.html", $params);
    }

    public static function page_attributions() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "Attributions",
            'content' => array(
                'attributions' => array(
                    'crypto' => array(
                        'label' => "Cryptographic Utilities",
                        'items' => array(
                            array(
                                'name' => array(
                                    'label' => "BitcoinJS",
                                    'href' => "https://bitcoinjs.org"
                                ),
                                'authors' => array(
                                    'label' => "bitcoinjs-lib contributors",
                                    'href' => "https://github.com/bitcoinjs/bitcoinjs-lib/graphs/contributors"
                                ),
                                'license' => array(
                                    'label' => "MIT",
                                    'href' => "https://github.com/bitcoinjs/bitcoinjs-lib/blob/master/LICENSE"
                                ),
                                'description' => array(
                                    'label' => "Bitcoin library"
                                )
                            ),
                            array(
                                'name' => array(
                                    'label' => "CryptoJS",
                                    'href' => "https://code.google.com/archive/p/crypto-js/"
                                ),
                                'authors' => array(
                                    'label' => "Jeff Mott",
                                    'href' => "https://code.google.com/archive/p/crypto-js/wikis/License.wiki"
                                ),
                                'license' => array(
                                    'label' => "New BSD License",
                                    'href' => "https://code.google.com/archive/p/crypto-js/"
                                ),
                                'description' => array(
                                    'label' => "Encryption and hashing library"
                                )
                            ),
                            array(
                                'name' => array(
                                    'label' => "JSEncrypt",
                                    'href' => "https://github.com/travist/jsencrypt"
                                ),
                                'authors' => array(
                                    'label' => "Travis Tidwell",
                                    'href' => "https://github.com/travist"
                                ),
                                'license' => array(
                                    'label' => "MIT",
                                    'href' => "https://github.com/travist/jsencrypt/blob/master/LICENSE.txt"
                                ),
                                'description' => array(
                                    'label' => "RSA library"
                                )
                            ),
                            array(
                                'name' => array(
                                    'label' => "jsSHA",
                                    'href' => "https://github.com/Caligatio/jsSHA"
                                ),
                                'authors' => array(
                                    'label' => "Brian Turek",
                                    'href' => "https://github.com/Caligatio"
                                ),
                                'license' => array(
                                    'label' => "New BSD License",
                                    'href' => "https://github.com/Caligatio/jsSHA/blob/master/LICENSE"
                                ),
                                'description' => array(
                                    'label' => "Enhanced SHA library"
                                )
                            )
                        )
                    ),
                    'other_js' => array(
                        'label' => "Other JavaScript Libraries",
                        'items' => array(
                            array(
                                'name' => array(
                                    'label' => "qrcode.js",
                                    'href' => "https://davidshimjs.github.io/qrcodejs"
                                ),
                                'authors' => array(
                                    'label' => "Sangmin, Shim",
                                    'href' => "https://github.com/davidshimjs"
                                ),
                                'license' => array(
                                    'label' => "MIT",
                                    'href' => "https://github.com/davidshimjs/qrcodejs/blob/master/LICENSE",
                                ),
                                'description' => array(
                                    'label' => "QR code generator"
                                )
                            )
                        )
                    ),
                    'design' => array(
                        'label' => "Design",
                        'items' => array(
                            array(
                                'name' => array(
                                    'label' => "Bootstrap",
                                    'href' => "https://getbootstrap.com/"
                                ),
                                'authors' => array(
                                    'label' => "Mark Otto, Jacob Thornton",
                                    'href' => "https://getbootstrap.com/about/"
                                ),
                                'license' => array(
                                    'label' => "MIT",
                                    'href' => "https://github.com/twbs/bootstrap/blob/master/LICENSE"
                                ),
                                'description' => array(
                                    'label' => "CSS framework"
                                )
                            ),
                            array(
                                'name' => array(
                                    'label' => "Font Awesome",
                                    'href' => "http://fontawesome.io/"
                                ),
                                'authors' => array(
                                    'label' => "Dave Gandy",
                                    'href' => "https://twitter.com/davegandy"
                                ),
                                'license' => array(
                                    'label' => "MIT",
                                    'href' => "http://fontawesome.io/"
                                ),
                                'description' => array(
                                    'label' => "Icons"
                                )
                            ),
                            array(
                                'name' => array(
                                    'label' => "Lock icon",
                                    'href' => "https://commons.wikimedia.org/wiki/File:Padlock-blue.svg"
                                ),
                                'authors' => array(
                                    'label' => "AJ Ashton",
                                    'href' => "https://commons.wikimedia.org/wiki/User:Eleassar"
                                ),
                                'license' => array(
                                    'label' => "Public domain",
                                    'href' => "https://commons.wikimedia.org/wiki/File:Padlock-blue.svg"
                                ),
                                'description' => array(
                                    'label' => "Favicon"
                                )
                            )
                        )
                    )
                )
            )
        );
        $cryptotools->displayTemplate("attributions.html", $params);
    }
}
