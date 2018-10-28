<?php

namespace App\Services\BOC;

use App\Services\BOC\Subscriptions\Accounts;
use App\Services\BOC\Subscriptions\Authorization;
use App\Services\BOC\Subscriptions\Payments;
use App\Services\BOC\Subscriptions\Subscription;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Zttp\Zttp;

class BOClient {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    public function __construct(BOCUrlFactory $urls) {

        $this->urls = $urls;
    }

    /**
     * @return mixed
     * @throws InvalidEndpointException
     */
    public function authorizeApp() {

        //        print_r($this->urls->endpoints('token'));

        return Zttp::asFormParams()->post($this->urls->endpoints('token'), [
            'client_id'     => env('BOC_CLIENT_ID'),
            'client_secret' => env('BOC_CLIENT_SECRET'),
            'grant_type'    => 'client_credentials',
            'scope'         => 'TPPOAuth2Security',
        ])->json();

    }

    public function getAppAccessToken() {

        return $this->authorizeApp()['access_token'];
    }

    public function authorization() {

        return new Authorization($this->urls);
    }

    public function accounts() {

        return new Accounts($this->urls, $this->getAppAccessToken());

    }

    public function payments() {

        return new Payments($this->urls);

    }

    public function subscriptions() {

        return new Subscription($this->urls, $this->getAppAccessToken());

    }

    public function showConsentScreen() {

        $subscriptionId = $this->subscriptions()->create();
        request()->user()->withSubscriptionId($subscriptionId);

        $endpoint = $this->urls->endpoints('auth') .
            '?response_type=code&redirect_uri=' .
            env('BOC_REDIRECT_URL') . '&scope=UserOAuth2Security&client_id='
            . env('BOC_CLIENT_ID') . '&subscriptionid=' . $subscriptionId . '&state=' . request()->user()->id;

        return redirect()->to($endpoint);

    }

    public function getSubscriptionAccessToken($code) {

        return Zttp::asFormParams()->post($this->urls->endpoints('token'), [
            'client_id'     => env('BOC_CLIENT_ID'),
            'client_secret' => env('BOC_CLIENT_SECRET'),
            'grant_type'    => 'authorization_code',
            'scope'         => 'UserOAuth2Security',
            'code'          => $code
        ])->json();

    }

    public function authorize() {

        /** @var User $user */
        $user = User::find(request()->get('state'));
        $subscriptionId = $user->subscription();

        $subscription = $this->subscriptions()->get($subscriptionId);
        $code = request()->get('code');

        $access_token = $this->getSubscriptionAccessToken($code)['access_token'];
        $user->withAccessToken($access_token);

        $this->subscriptions()->patch($access_token, $subscription);
        $account = collect($subscription->selectedAccounts)->first();

        $currentAccount = $this->accounts()->get($subscriptionId, $account->accountId);
        return $user->withAccount($currentAccount);
    }
}

/*

 */
