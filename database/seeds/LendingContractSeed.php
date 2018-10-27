<?php

use Illuminate\Database\Seeder;

class LendingContractSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $table->integer('user_id');
        //            $table->string('subscription_id')->nullable();
        //            $table->string('access_token')->nullable();
        //            $table->dateTime('from')->nullable();
        //            $table->dateTime('to')->nullable();
        //            $table->integer('amount')->default(1000)->nullable();
        //            $table->integer('rate')->nullable();
        //            $table->integer('suggested_rate')->nullable();
        //            $table->string('status')->nullable();
        //            $table->integer('accepted_by_borrower_id')->nullable();
        //            $table->timestamp('accepted_at')->nullable();
//
        \App\LendingContract::query()->truncate();
        \App\LendingContract::query()->create([
            'subscription_id' => 'lender_subscription',
            'access_token' => 'lender_token',
            'from' => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
            'to' => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
            'amount' => rand(1000,200000),
            'rate' => rand(2,15),
            'suggested_rate' => rand(1,10),
//            'status' => 'sfsdf',
//            'accepted_by_borrower_id' => 'sfsdf',
        ]);
    }
}
