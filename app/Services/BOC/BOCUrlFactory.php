<?php

namespace App\Services\BOC;

use Illuminate\Support\Facades\Session;
use Zttp\Zttp;

class BOCUrlFactory {

    private $boc_endpoints = [
        'token'                  => '/psd2/oauth2/token',
        'subscriptions'          => '/psd2/v1/subscriptions',
        'subscriptions/accounts' => '/psd2/v1/subscriptions/accounts',
        'accounts'               => '/psd2/v1/accounts',
        'payments'               => '/psd2/v1/payments',
        'payments/accounts'      => '/psd2/v1/payments/accounts/',
        'payments/funds'         => '/psd2/v1/payments/fundAvailability',
        'payments/groups'        => '/psd2/v1/payments/groupPayments',
        'mass_payments'          => '/psd2/v1/massPayments',
        'sign'                   => '/jwssignverifyapi/sign',
        'verify'                 => '/jwssignverifyapi/verify',
        'auth'                   => '/psd2/oauth2/authorize',
        'introspect'             => '/psd2/oauth2/introspect',
        'cif'                    => '/psd2/v1/customers',
    ];

    private function url($url) {

        return vsprintf('%s/%s', [
            'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb', ltrim($url, '/'),
        ]);
    }

    /**
     * @param $key
     * @return string
     * @throws InvalidEndpointException
     */
    public function endpoints($key) {

        if (array_has($this->boc_endpoints, $key)) {
            return $this->url(array_get($this->boc_endpoints, $key));
        }

        throw new InvalidEndpointException();
    }


}
