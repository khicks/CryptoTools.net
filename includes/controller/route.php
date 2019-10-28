<?php

class CryptoToolsRoute {
    public static function page_home() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "Home",
            'include' => [
                'js' => [
                    'root' => [
                        "home.js"
                    ]
                ]
            ],
            'navigation' => [
                'home' => [
                    'active' => true
                ]
            ]
        ];
        $cryptotools->displayTemplate("home.html", $params);
    }

    public static function page_aes_string() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "AES String Encryption and Decryption",
            'include' => [
                'css' => [
                    'root' => [
                        "aes-string.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        //"CryptoJS/aes.js",
            "CryptoJS/crypto-js.js",
                        "aes-string.js"
                    ]
                ]
            ],
            'navigation' => [
                'symmetric' => [
                    'active' => true,
                    'items' => [
                        'aes_string' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("aes-string.html", $params);
    }

    public static function page_rsa_gen() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "RSA Key Generator",
            'include' => [
                'css' => [
                    'root' => [
                        "rsa-gen.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "JSEncrypt/jsencrypt.min.js",
                        "rsa-gen.js"
                    ]
                ]
            ],
            'navigation' => [
                'asymmetric' => [
                    'active' => true,
                    'items' => [
                        'rsagen' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("rsa-gen.html", $params);
    }

    public static function page_dhe() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "Diffie-Hellman Key Exchange",
            'include' => [
                'css' => [
                    'root' => [
                        "dhe.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "elliptic.min.js",
                        "dhe.js"
                    ]
                ]
            ],
            'navigation' => [
                'asymmetric' => [
                    'active' => true,
                    'items' => [
                        'dhe' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("dhe.html", $params);
    }

    public static function page_hash_string() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "String Hash Calculator",
            'include' => [
                'css' => [
                    'root' => [
                        "hash-string.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "CryptoJS/md5.js",
                        "CryptoJS/ripemd160.js",
                        "sha.js",
                        "hash-string.js"
                    ]
                ]
            ],
            'navigation' => [
                'hashing' => [
                    'active' => true,
                    'items' => [
                        'hash_string' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("hash-string.html", $params);
    }

    public static function page_hmac_string() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "String HMAC Calculator",
            'include' => [
                'css' => [
                    'root' => [
                        "hmac-string.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "CryptoJS/hmac-md5.js",
                        "CryptoJS/hmac-ripemd160.js",
                        "sha.js",
                        "hmac-string.js"
                    ]
                ]
            ],
            'navigation' => [
                'hashing' => [
                    'active' => true,
                    'items' => [
                        'hmac_string' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("hmac-string.html", $params);
    }

    public static function page_otp() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "One-Time Password Calculator",
            'include' => [
                'css' => [
                    'root' => [
                        "otp.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "qrcode.min.js",
                        "sha.js",
                        "otp.js"
                    ]
                ]
            ],
            'navigation' => [
                'hashing' => [
                    'active' => true,
                    'items' => [
                        'otp' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("otp.html", $params);
    }

    public static function page_base64() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "Base64 Converter",
            'include' => [
                'css' => [
                    'root' => [
                        "base64.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "base64.js"
                    ]
                ]
            ],
            'navigation' => [
                'other' => [
                    'active' => true,
                    'items' => [
                        'base64' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("base64.html", $params);
    }

    public static function page_bitcoin() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "Bitcoin Address Generator",
            'include' => [
                'css' => [
                    'root' => [
                        "bitcoin-tools.css"
                    ]
                ],
                'js' => [
                    'root' => [
                        "bitcoinjs.min.js",
                        "bitcoin-tools.js"
                    ]
                ]
            ],
            'navigation' => [
                'other' => [
                    'active' => true,
                    'items' => [
                        'bitcoin-tools' => [
                            'active' => true
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("bitcoin-tools.html", $params);
    }

    public static function page_about() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "About"
        ];
        $cryptotools->displayTemplate("about.html", $params);
    }

    public static function page_attributions() {
        $cryptotools = new CryptoToolsPage();
        $params = [
            'title' => "Attributions",
            'content' => [
                'attributions' => [
                    'crypto' => [
                        'label' => "Cryptographic Utilities",
                        'items' => [
                            [
                                'name' => [
                                    'label' => "BitcoinJS",
                                    'href' => "https://bitcoinjs.org"
                                ],
                                'authors' => [
                                    'label' => "bitcoinjs-lib contributors",
                                    'href' => "https://github.com/bitcoinjs/bitcoinjs-lib/graphs/contributors"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/bitcoinjs/bitcoinjs-lib/blob/master/LICENSE"
                                ],
                                'description' => [
                                    'label' => "Bitcoin library"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "CryptoJS",
                                    'href' => "https://code.google.com/archive/p/crypto-js/"
                                ],
                                'authors' => [
                                    'label' => "Jeff Mott",
                                    'href' => "https://code.google.com/archive/p/crypto-js/wikis/License.wiki"
                                ],
                                'license' => [
                                    'label' => "New BSD License",
                                    'href' => "https://code.google.com/archive/p/crypto-js/"
                                ],
                                'description' => [
                                    'label' => "Encryption and hashing library"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "Elliptic",
                                    'href' => "https://github.com/indutny/elliptic",
                                ],
                                'authors' => [
                                    'label' => "Fedor Indutny",
                                    'href' => "https://github.com/indutny"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/indutny/elliptic#license"
                                ],
                                'description' => [
                                    'label' => "DHE library"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "JSEncrypt",
                                    'href' => "https://github.com/travist/jsencrypt"
                                ],
                                'authors' => [
                                    'label' => "Travis Tidwell",
                                    'href' => "https://github.com/travist"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/travist/jsencrypt/blob/master/LICENSE.txt"
                                ],
                                'description' => [
                                    'label' => "RSA library"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "jsSHA",
                                    'href' => "https://github.com/Caligatio/jsSHA"
                                ],
                                'authors' => [
                                    'label' => "Brian Turek",
                                    'href' => "https://github.com/Caligatio"
                                ],
                                'license' => [
                                    'label' => "New BSD License",
                                    'href' => "https://github.com/Caligatio/jsSHA/blob/master/LICENSE"
                                ],
                                'description' => [
                                    'label' => "Enhanced SHA library"
                                ]
                            ],
                        ]
                    ],
                    'other_js' => [
                        'label' => "Other JavaScript Libraries",
                        'items' => [
                            [
                                'name' => [
                                    'label' => "jQuery",
                                    'href' => "https://jquery.com/"
                                ],
                                'authors' => [
                                    'label' => "The jQuery Foundation",
                                    'href' => "https://jquery.org/team/"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/jquery/jquery/blob/master/LICENSE.txt",
                                ],
                                'description' => [
                                    'label' => "DOM traversal, event handling, etc."
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "popper.js",
                                    'href' => "https://popper.js.org/"
                                ],
                                'authors' => [
                                    'label' => "Federico Zivolo",
                                    'href' => "https://github.com/FezVrasta"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/FezVrasta/popper.js/blob/master/LICENSE.md",
                                ],
                                'description' => [
                                    'label' => "Tooltips"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "qrcode.js",
                                    'href' => "https://davidshimjs.github.io/qrcodejs"
                                ],
                                'authors' => [
                                    'label' => "Sangmin, Shim",
                                    'href' => "https://github.com/davidshimjs"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/davidshimjs/qrcodejs/blob/master/LICENSE",
                                ],
                                'description' => [
                                    'label' => "QR code generator"
                                ]
                            ]
                        ]
                    ],
                    'design' => [
                        'label' => "Design",
                        'items' => [
                            [
                                'name' => [
                                    'label' => "Bootstrap",
                                    'href' => "https://getbootstrap.com/"
                                ],
                                'authors' => [
                                    'label' => "Mark Otto, Jacob Thornton",
                                    'href' => "https://getbootstrap.com/about/"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "https://github.com/twbs/bootstrap/blob/master/LICENSE"
                                ],
                                'description' => [
                                    'label' => "CSS framework"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "Font Awesome",
                                    'href' => "http://fontawesome.io/"
                                ],
                                'authors' => [
                                    'label' => "Dave Gandy",
                                    'href' => "https://twitter.com/davegandy"
                                ],
                                'license' => [
                                    'label' => "MIT",
                                    'href' => "http://fontawesome.io/"
                                ],
                                'description' => [
                                    'label' => "Icons"
                                ]
                            ],
                            [
                                'name' => [
                                    'label' => "Lock icon",
                                    'href' => "https://commons.wikimedia.org/wiki/File:Padlock-blue.svg"
                                ],
                                'authors' => [
                                    'label' => "AJ Ashton",
                                    'href' => "https://commons.wikimedia.org/wiki/User:Eleassar"
                                ],
                                'license' => [
                                    'label' => "Public domain",
                                    'href' => "https://commons.wikimedia.org/wiki/File:Padlock-blue.svg"
                                ],
                                'description' => [
                                    'label' => "Favicon"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $cryptotools->displayTemplate("attributions.html", $params);
    }
}
