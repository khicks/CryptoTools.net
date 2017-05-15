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

    public static function page_attributions() {
        $cryptotools = new CryptoToolsPage();
        $params = array(
            'title' => "Attributions",
            'content' => array(
                'attributions' => array(
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
