<?php

namespace App\Services\BOC\Subscriptions;

use App\Services\BOC\BOCUrlFactory;

class Authorization {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    private $headers = [

    ];

    public function __construct(BOCUrlFactory $urls) {

        $this->urls = $urls;
    }

    public function authorize() {

        // ?response_type=REPLACE_THIS_VALUE&
        //redirect_uri=REPLACE_THIS_VALUE&
        //state=REPLACE_THIS_VALUE&
        //scope=REPLACE_THIS_VALUE&
        //subscriptionid=REPLACE_THIS_VALUE

        $state = uniqid();
        Session::put('_state', $state);
        $response = Zttp::withHeaders([
            'accept' => 'text/html'
        ])->get($this->urls->endpoints('authorize'), [
            'response_type'  => 'token',
            'redirect_uri'   => env('BOC_REDIRECT_URL'),
            'state'          => $state,
            'scope'          => '*',
            'subscriptionid' => '',
        ]);

        return $response;

    }
}
