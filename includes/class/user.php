<?php

class CryptoToolsUser {
    public $user_id;
    public $username;
    public $password;
    public $is_admin;
    public $disabled;
    public $two_factor_key;

    /* @var CryptoTools */
    protected $cryptotools;

    public function __construct(CryptoTools $cryptotools, $user_id) {
        $this->cryptotools = $cryptotools;
        $this->user_id = null;
        $this->username = null;
        $this->password = null;
        $this->is_admin = null;
        $this->disabled = null;
        $this->two_factor_key = null;
    }
}

class CryptoToolsCurrentUser extends CryptoToolsUser {
    public $csrf_token;

    /** @var CryptoToolsCurrentSession */
    public $session;

    public function __construct($freepass, $user_id) {
        parent::__construct($freepass, $user_id);
        $this->csrf_token = $_SESSION['csrf_token'];

        if (!empty($this->user_id)) {
            $this->session = new CryptoToolsCurrentSession($this->cryptotools, $this->user_id);
            if (!$this->session->check()) {
                $this->user_id = null;
                $this->username = null;
                $this->password = null;
                $this->is_admin = null;
                $this->disabled = null;
            };
        }
    }

    public function isLoggedIn() {
        if (!empty($this->user_id) && !$this->disabled) {
            return true;
        }
        return false;
    }

    public function getUser() {
        return array(
            'id' => $this->user_id,
            'username' => $this->username,
            'csrf_token' => $this->csrf_token
        );
    }
}
