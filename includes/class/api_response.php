<?php

class CryptoToolsAPIResponse {
    protected $status;
    protected $code;
    protected $description;
    protected $data;

    protected function __construct() {}

    public function respond() {
        header('Content-Type: application/json');
        die(json_encode(array(
            'status' => $this->status,
            'code' => $this->code,
            'description' => $this->description,
            'data' => $this->data
        )));
    }
}
