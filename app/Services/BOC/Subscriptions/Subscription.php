<?php

namespace App\Services\BOC\Subscriptions;

use App\Services\BOC\BOCUrlFactory;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;

use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zttp\Zttp;
use GuzzleHttp\Client;

class Subscription {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    private $application_token;

    private $endpoint;

    private $logger;

    private $stack;

    private $client;

    public function __construct(BOCUrlFactory $urls, $application_token) {

        $this->stack = HandlerStack::create();
        $this->logger = new Logger('Logger');
        try {
            $this->logger->pushHandler(new StreamHandler('log.log', Logger::DEBUG));
        } catch (\Exception $e) {
        }

        $this->stack->push(
            Middleware::log(
                $this->logger,
                new MessageFormatter('>>>>>>>>\n{request}\n\n<<<<<<<<\n{response}\n--------\n\n{error}')
            )
        );

        $this->urls = $urls;
        $this->application_token = $application_token;
        $this->endpoint = $this->urls->endpoints('subscriptions') .
            '?client_id=' . env('BOC_CLIENT_ID') .
            '&client_secret=' . env('BOC_CLIENT_SECRET');

        $this->client = new Client([
            'base_uri' => $this->endpoint,
            'handler'  => $this->stack,
        ]);
    }

    private function endpointWithSecrets($key = null) {

        return $this->urls->endpoints('subscriptions') . '/' . $key .
            '?client_id=' . env('BOC_CLIENT_ID') .
            '&client_secret=' . env('BOC_CLIENT_SECRET');

    }

    public function create() {

        $header = [
            'cache-control'       => 'no-cache',
            'journeyId'           => env('BOC_JOURNEY_ID'),
            'timeStamp'           => '1540493118',
            'originUserId'        => env('BOC_ORIGIN_USER_ID'),
            'tppid'               => env('BOC_TPPID'),
            'app_name'            => 'bitsilly',
            'APIm-Debug-Trans-Id' => 'true',
            'Content-Type'        => 'application/json',
            'Authorization'       => 'Bearer ' . $this->application_token
        ];

        $body = [
            'accounts' =>
                [
                    'transactionHistory'     => true,
                    'balance'                => true,
                    'details'                => true,
                    'checkFundsAvailability' => true,
                ],
            'payments' =>
                [
                    'limit'    => 99999999,
                    'currency' => 'EUR',
                    'amount'   => 999999999,
                ],
        ];

        $request = new Request('POST', $this->endpoint);

        try {
            $response = $this->client->send($request, [
                    'headers' => $header,
                    'json'    => $body
                ]
            );

            $subscription = json_decode((string) $response->getBody())->subscriptionId;

        } catch (\Exception $e) {

            dump($e->getMessage());
        }

        return $subscription;
    }

    public function get($subscriptionId) {

        $header = [
            'journeyId'           => env('BOC_JOURNEY_ID'),
            'timeStamp'           => '1540493118',
            'originUserId'        => env('BOC_ORIGIN_USER_ID'),
            'tppid'               => env('BOC_TPPID'),
            'app_name'            => 'bitsilly',
            'APIm-Debug-Trans-Id' => 'true',
            'Content-Type'        => 'application/json',
            'Authorization'       => 'Bearer ' . $this->application_token
        ];

        $request = new Request('GET', $this->endpointWithSecrets($subscriptionId));

        try {
            $response = $this->client->send($request, [
                    'headers' => $header,
                ]
            );

            $subscription = json_decode((string) $response->getBody());

        } catch (\Exception $e) {

            dump($e->getMessage());
        }

        return $subscription[0];

    }

    public function patch($code, $body) {

        $data = json_decode(json_encode($body), true);

        //        dd($data);

        $header = [
            'journeyId'           => env('BOC_JOURNEY_ID'),
            'timeStamp'           => '1540493118',
            'originUserId'        => env('BOC_ORIGIN_USER_ID'),
            'tppid'               => env('BOC_TPPID'),
            'app_name'            => 'bitsilly',
            'APIm-Debug-Trans-Id' => 'true',
            'Content-Type'        => 'application/json',
            'Authorization'       => 'Bearer ' . $code
        ];

        $subscriptionId = $data['subscriptionId'];

        $request = new Request('PATCH', $this->endpointWithSecrets($subscriptionId));

        try {
            $response = $this->client->send($request, [
                    'headers' => $header,
                    'json'    => [
                        'selectedAccounts' => $data['selectedAccounts'],
                        'accounts'         => $data['accounts'],
                        'payments'         => $data['payments'],
                    ]
                ]
            );

            //            dd((string) $response->getBody());

            $subscription = json_decode((string) $response->getBody(), true);

        } catch (\Exception $e) {

            dump($e->getMessage());
        }

        return $subscription;

    }

    public function accounts($subscriptionId) {

        $endpoint = $this->endpointWithSecrets('accounts/' . $subscriptionId);
        $header = [
            'journeyId'           => env('BOC_JOURNEY_ID'),
            'timeStamp'           => '1540493118',
            'originUserId'        => env('BOC_ORIGIN_USER_ID'),
            'tppid'               => env('BOC_TPPID'),
            'app_name'            => 'bitsilly',
            'APIm-Debug-Trans-Id' => 'true',
            'Content-Type'        => 'application/json',
            'Authorization'       => 'Bearer ' . $this->application_token
        ];

        $request = new Request('GET', $endpoint);

        try {
            $response = $this->client->send($request, [
                    'headers' => $header
                ]
            );

            //            dd((string) $response->getBody());

            $subscription = json_decode((string) $response->getBody(), true);

        } catch (\Exception $e) {

            dump($e->getMessage());
        }

        return $subscription;

    }
}
