<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LendingContract extends Model {

    protected $guarded = [];

    public static function createDemo() {

        return static::query()->create([
                'user_id' => request()->user()->id,
                'subscription_id' => request()->user()->subscription(),
                'access_token' => request()->user()->access_token,
                'from' => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
                'to' => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
                'amount' => rand(1000,200000),
                'rate' => rand(2,15),
                'suggested_rate' => rand(1,10),
                //            'status' => 'sfsdf',
                //            'accepted_by_borrower_id' => 'sfsdf',

        ]);
    }

    public function user() {

        return $this->belongsTo(User::class);

    }
}
