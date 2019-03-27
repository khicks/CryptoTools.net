<?php

class CryptoToolsAPISuccess extends CryptoToolsAPIResponse {
    public function __construct($code = "GENERAL_SUCCESS", $description = "", $data = array()) {
        parent::__construct();
        $this->status = "success";
        $this->code = $code;
        $this->description = $description;
        $this->data = $data;
    }
}