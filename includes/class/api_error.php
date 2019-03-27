<?php

class CryptoToolsAPIError extends CryptoToolsAPIResponse  {
    private $http_code;

    public function __construct($http_code, $code = "GENERAL_ERROR", $description = "", $data = array()) {
        parent::__construct();
        $this->http_code = $http_code;
        $this->status = "error";
        $this->code = $code;
        $this->description = $description;
        $this->data = $data;
    }

    public function respond() {
        http_response_code($this->http_code);
        parent::respond();
    }
}
