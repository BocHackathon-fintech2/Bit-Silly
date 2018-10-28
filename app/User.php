<?php

namespace App;

use App\Services\OpenCorporates;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Parent_;

class User extends Authenticatable {

    use Notifiable;

    public static function boot() {

        parent::boot();

    }

    protected $guarded = [];

    protected $casts = [
        'account' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function withSubscriptionId($subscription) {

        $this->subscription_id = $subscription;
        $this->save();

        return $this;
    }

    public function subscription() {

        return $this->subscription_id;

    }

    public function withAccessToken($token) {

        $this->access_token = $token;
        $this->save();

        return $this;
    }

    public function withAccount($account) {

        session('account', $account);
        $this->account = $account;
        $this->save();

        auth()->login($this);
        //        Auth::login($this);

        if ($this->isBorrower()) {

            BorrowContract::createDemo();
        }

        if ($this->isLender()) {

            LendingContract::createDemo();
        }

        return $this;
    }

    public function getOCProfile() {

        $oc = OpenCorporates::info($this->country, $this->registration_number);

        if (isset($oc['results'])) {
            return array_get($oc, 'results.company');
        }

        return [];
    }

    public function hasAccount() {

        return isset($this->account);

    }

    public function isLender() {

        return $this->role == 'lender';

    }

    public function isBorrower() {

        return $this->role === 'borrower';

    }

    public function lendings() {

        return $this->hasMany(LendingContract::class);
    }

    public function borrowings() {

        return $this->hasMany(BorrowContract::class);

    }
}
