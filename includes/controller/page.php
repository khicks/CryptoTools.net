<?php

class CryptoToolsPage extends CryptoTools {
    /** @var Twig_Environment */
    public $twig;

    public function __construct() {
        parent::__construct();
        $this->loadTwig();
    }

    private function loadTwig() {
        $templates[] = $this->php_root."/templates";
        $loader = new Twig_Loader_Filesystem($templates);
        $this->twig = new Twig_Environment($loader);
    }

    public function renderTemplate($filename, $params = array()) {
        return $this->twig->render($filename, $this->getTemplateParams($params));
    }

    public function displayTemplate($filename, $params = array()) {
        $this->twig->display($filename, $this->getTemplateParams($params));
    }

    public function getTemplateParams($params = array()) {
        $init_params = array(
            'appname' => $this->config['app_name'],
            'webroot' => $this->web_root,
            'google_analytics_tracking_id' => $this->config['google_analytics_tracking_id'],
            'include' => array(
                'css' => array(
                    'external' => array(),
                    'root' => array(
                        "bootstrap.min.css",
                        "font-awesome.min.css",
                        "cryptotools.css"
                    )
                ),
                'js' => array(
                    'external' => array(),
                    'root' => array(
                        "jquery.min.js",
                        "popper.min.js",
                        "bootstrap.min.js",
                        "cryptotools.js"
                    )
                )
            ),
            'display' => array(
                'navigation' => true,
                'logout' => $this->current_user->isLoggedIn(),
                'title' => true,
                'footer' => true
            ),
            'brand' => array(
                'href' => "{$this->web_root}/",
                'label' => $this->config['app_name']
            ),
            'navigation' => array(
                'home' => array(
                    'type' => "link",
                    'href' => "{$this->web_root}/",
                    'icon' => "fa-home",
                    'label' => "Home",
                    'active' => false
                ),
                'symmetric' => array(
                    'type' => "dropdown",
                    'icon' => "fa-exchange",
                    'label' => "Symmetric",
                    'active' => false,
                    'items' => array(
                        'aes_string' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/aes",
                            'icon' => "fa-key",
                            'label' => "AES String Encryption and Decryption",
                            'active' => false
                        )
                    )
                ),
                'asymmetric' => array(
                    'type' => "dropdown",
                    'icon' => "fa-refresh",
                    'label' => "Asymmetric",
                    'active' => false,
                    'items' => array(
                        'rsagen' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/rsagen",
                            'icon' => "fa-certificate",
                            'label' => "RSA Key Generator",
                            'active' => false
                        ),
                        'dhe' => [
                            'type' => "link",
                            'href' => "{$this->web_root}/dhe",
                            'icon' => "fa-exchange",
                            'label' => "Diffie-Hellman Key Exchange",
                            'active' => false
                        ]
                    )
                ),
                'hashing' => array(
                    'type' => "dropdown",
                    'icon' => "fa-random",
                    'label' => "Hashing",
                    'active' => false,
                    'items' => array(
                        'hash_string' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/hash",
                            'icon' => "fa-calculator",
                            'label' => "String Hash Calculator",
                            'active' => false
                        ),
                        'otp' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/otp",
                            'icon' => "fa-clock-o",
                            'label' => "One-Time Password Calculator",
                            'active' => false
                        )
                    )
                ),
                'other' => array(
                    'type' => "dropdown",
                    'icon' => "fa-question",
                    'label' => "Other",
                    'active' => false,
                    'items' => array(
                        'base64' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/base64",
                            'icon' => "fa-retweet",
                            'label' => "Base64 Converter",
                            'active' => false
                        ),
                        'bitcoin-tools' => array(
                            'type' => "link",
                            'href' => "{$this->web_root}/bitcoin",
                            'icon' => "fa-bitcoin",
                            'label' => "Bitcoin Address Generator",
                            'active' => false
                        )
                    )
                )
            ),
            'footer' => array(
                'copyright' => array(
                    'year' => date("Y"),
                    'name' => "CryptoTools.net"
                ),
                'menu' => array(
                    'home' => array(
                        'href' => "{$this->web_root}/",
                        'label' => "Home"
                    ),
                    'about' => array(
                        'href' => "{$this->web_root}/about",
                        'label' => "About"
                    ),
                    'github' => array(
                        'href' => "{$this->config['github_link']}",
                        'label' => "GitHub"
                    ),
                    'attributions' => array(
                        'href' => "{$this->web_root}/attributions",
                        'label' => "Attributions"
                    ),
                    'contact' => array(
                        'href' => "{$this->web_root}/contact",
                        'label' => "Contact"
                    )
                )
            ),
            'current_user' => $this->current_user,
            'content' => array()
        );

        $page_params = $this->mergeParams($init_params, $params);

        for ($i=0; $i<count($page_params['include']['css']['root']); $i++) {
            $page_params['include']['css']['root'][$i] = "{$this->web_root}/css/{$page_params['include']['css']['root'][$i]}";
        }
        for ($i=0; $i<count($page_params['include']['js']['root']); $i++) {
            $page_params['include']['js']['root'][$i] = "{$this->web_root}/js/{$page_params['include']['js']['root'][$i]}";
        }

        return $page_params;
    }

    private function mergeParams($init_params, $params) {
        foreach($params as $key => $value) {
            if(array_key_exists($key, $init_params) && is_array($value)) {
                if ($this->isAssocArray($value)) {
                    $init_params[$key] = $this->mergeParams($init_params[$key], $params[$key]);
                }
                else {
                    $init_params[$key] = array_merge($init_params[$key], $params[$key]);
                }
            }
            else {
                $init_params[$key] = $value;
            }
        }
        return $init_params;
    }

    private function isAssocArray($arr) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
