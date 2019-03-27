<?php

require("includes/controller/api.php");
require("includes/controller/page.php");
require("includes/controller/route.php");

class CryptoTools {
    public $php_root;
    public $web_root;
    public $config;

    /** @var  CryptoToolsCurrentUser */
    public $current_user;

    /** @var  PDO */
    public $db;

    /** @var  PHPMailer */
    public $mailer;

    public function __construct() {
        $this->loadDirectories();
        $this->loadFiles();
        $this->loadConfig();
        $this->startSession();
    }

    private function loadDirectories() {
        $this->php_root = dirname(dirname(__FILE__));
        $this->web_root = dirname($_SERVER['SCRIPT_NAME']);

        if (substr($this->web_root, -1) == "/") {
            $this->web_root = substr($this->web_root, 0, -1);
        }
    }

    private function loadFiles() {
        require_once('includes/class/user.php');
        require_once('includes/class/session.php');
        require_once('includes/class/twofactor.php');
    }

    private function loadConfig() {
        if (file_exists("config.php")) {
            $this->config = require_once("config.php");
        }
        else {
            die("No config.");
        }
    }

    private function startSession() {
        session_name("cryptotools_session");
        session_set_cookie_params(0, $this->web_root, null, true, true);
        session_start();

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }

        $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : null;
        $this->current_user = new CryptoToolsCurrentUser($this, $user_id);
    }
}