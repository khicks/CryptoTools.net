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
                                    'label' => "Lock icon",
                                    'href' => "http://www.iconarchive.com/show/colorful-long-shadow-icons-by-graphicloads/Lock-icon.html"
                                ),
                                'authors' => array(
                                    'label' => "GraphicLoads",
                                    'href' => "http://graphicloads.com/"
                                ),
                                'license' => array(
                                    'label' => "Freeware",
                                    'href' => "http://www.iconarchive.com/show/colorful-long-shadow-icons-by-graphicloads/Lock-icon.html"
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