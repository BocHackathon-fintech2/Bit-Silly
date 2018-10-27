<?php

namespace App\Http\Controllers;

use App\LendingContract;
use Illuminate\Http\Request;

class ActionController extends Controller {

    public function index() {

        return view('actions');
    }

    public function lend() {

        // TODO Authorize BOC Api
        return view('lend');
    }

    public function borrow() {

        // TODO Authorize BOC Api
        return view('borrow');

    }

    public function createLend(Request $request) {

//        $table->integer('user_id');
//        $table->string('subscription_id')->nullable();
//        $table->string('access_token')->nullable();
//        $table->string('response')->nullable();
//        $table->dateTime('from')->nullable();
//        $table->dateTime('to')->nullable();
//        $table->integer('amount')->default(1000)->nullable();
//        $table->integer('rate')->nullable();
//        $table->integer('suggested_rate')->nullable();
//        $table->string('status')->nullable();
//        $table->integer('accepted_by_borrower_id')->nullable();
//        $table->timestamp('accepted_at')->nullable();

        $data = $this->validate($request, [
            'from'   => 'required|date',
            'to'     => 'required|date',
            'amount' => 'required|number',
            'rate'   => 'required|number',
        ]);

        LendingContract::query()->create($data);

    }

    public function createBorrow() {


    }
}
