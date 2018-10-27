<?php

namespace App\Services\BOC;

class InvalidEndpointException extends \Exception {

    /**
     * InvalidEndpointException constructor.
     */
    public function __construct() {

        parent::__construct("Invalid BOC Endpoint");
    }
}
