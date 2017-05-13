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
            'include' => array(
                'css' => array(
                    'external' => array(),
                    'root' => array(
                        "bootstrap.min.css",
                        "cryptotools.css"
                    )
                ),
                'js' => array(
                    'external' => array(),
                    'root' => array(
                        "jquery.min.js"
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

    public static function home() {
        $cryptotools = new self();
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
}
