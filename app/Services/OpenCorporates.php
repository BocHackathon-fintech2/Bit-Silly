<?php

namespace App\Services;

use Zttp\Zttp;

class OpenCorporates {

    public static function info($country, $code) {

        return Zttp::get('https://api.opencorporates.com/companies/' . $country . '/' . $code)->json();
    }
}
