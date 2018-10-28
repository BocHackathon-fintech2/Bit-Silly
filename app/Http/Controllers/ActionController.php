<?php

namespace App\Http\Controllers;

use App\BorrowContract;
use App\Declaration;
use App\LendingContract;
use App\Services\BOC\BOClient;
use App\User;
use Illuminate\Http\Request;

class ActionController extends Controller {

    public function __construct() {

        $this->middleware('auth');

    }

    public function kyc(User $user) {

        return view('profile')->with('kycUser', $user);

    }

    public function match(LendingContract $lending) {

        $contracts = BorrowContract::query()->get()->where('user_id', '!=', \request()->user()->id);

        return view('matches')->with('lending', $lending)->with('borrowings',$contracts);

    }

    public function index() {

        return view('actions');
    }

    public function lend() {

        return view('lend');
    }

    public function borrow() {

        return view('borrow');

    }

    public function createLend(Request $request) {

        $data = $this->validate($request, [
            'from'   => 'required|date',
            'to'     => 'required|date',
            'amount' => 'required|integer',
            'rate'   => 'required|integer',
        ]);

        LendingContract::query()->create($data);

    }

    public function createBorrow(Request $request) {

        $data = $this->validate($request, [
            'from'   => 'required|date', // date range
            'to'     => 'required|date',
            'amount' => 'required|integer', // the amount that a person needs
        ]);

        BorrowContract::query()->create($data);
    }

    public function createDeclaration(Request $request) {

        $data = $this->validate($request, [
            'name'  => 'required|string', // date range
            'value' => 'required|number',
            'type'  => 'required|text', // the amount that a person needs
            'rate'  => 'required|number',

        ]);

        Declaration::query()->create($data);
    }
}
