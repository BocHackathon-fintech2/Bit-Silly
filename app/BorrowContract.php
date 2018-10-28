<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowContract extends Model {

    //
    protected $guarded = [];

    public static function createDemo() {

        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);
        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);
        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);
        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);
        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);
        static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);

        return static::query()->create([
            'user_id' => request()->user()->id,
            'from'    => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to'      => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount'  => rand(1000, 100000),
        ]);

    }

    public function user() {

        return $this->belongsTo(User::class);

    }
}
