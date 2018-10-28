<?php

namespace App\Services\BOC\Subscriptions;

use App\Services\BOC\BOClient;
use App\Services\BOC\BOCUrlFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Accounts {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    /**
     * @var BOClient
     */
    private $client;

    private $application_token;

    private function endpointWithSecrets($key = null) {

        return $this->urls->endpoints('accounts') . '/' . $key .
            '?client_id=' . env('BOC_CLIENT_ID') .
            '&client_secret=' . env('BOC_CLIENT_SECRET');

    }

    public function __construct(BOCUrlFactory $urls, $application_token) {

        $this->urls = $urls;
        $this->application_token = $application_token;

        $this->client = new Client();
    }

    public function get($subscriptionId, $accountId) {

        $endpoint = $this->endpointWithSecrets($accountId);
        $header = [
            'journeyId'           => env('BOC_JOURNEY_ID'),
            'timeStamp'           => '1540493118',
            'originUserId'        => env('BOC_ORIGIN_USER_ID'),
            'tppid'               => env('BOC_TPPID'),
            'subscriptionId'      => $subscriptionId,
            'app_name'            => 'bitsilly',
            'APIm-Debug-Trans-Id' => 'true',
            'Content-Type'        => 'application/json',
            'Authorization'       => 'Bearer ' . $this->application_token
        ];

        //        var_dump($endpoint);
        $request = new Request('GET', $endpoint);

        try {
            $response = $this->client->send($request, [
                    'headers' => $header
                ]
            );

            //            dd((string) $response->getBody());

            $account = json_decode((string) $response->getBody(), true);

        } catch (\Exception $e) {

            dump($e->getMessage());
        }
        $currentAccount = collect($account)->first();

        return $currentAccount;
    }
}
