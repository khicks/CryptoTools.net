<?php

class CryptoToolsAPI extends CryptoTools {
    /** @var  APISuccess|APIError */
    public $response;

    public function __construct($csrf_required = true) {
        parent::__construct();
        $this->loadFiles();
        if ($csrf_required) {
            $this->checkCSRF();
        }
    }

    private function loadFiles() {
        require_once("includes/class/response.php");
        require_once("includes/class/success.php");
        require_once("includes/class/error.php");
    }

    private function checkCSRF() {
        if ($this->config['csrf_required'] && (!isset($_REQUEST['csrf_token']) || $_REQUEST['csrf_token'] !== $this->current_user->csrf_token)) {
            $this->response = new APIError(401, "CSRF_FAILED", "A CSRF token was not provided or did not match.");
            $this->response->respond();
        }
    }

    public static function test() {
        $application = new self();
        $application->response = new APISuccess("TEST_SUCCESS", "You did it!");
        $application->response->respond();
    }
}