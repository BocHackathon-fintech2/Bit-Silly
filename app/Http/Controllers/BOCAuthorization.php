<?php

namespace App\Http\Controllers;

use App\Services\BOC\BOClient;
use Illuminate\Http\Request;

class BOCAuthorization extends Controller {

    private $boc;

    /**
     * BOCAuthorization constructor.
     * @param BOClient $boc
     */
    public function __construct(BOClient $boc) {

        $this->middleware('auth')->except('callback');

        $this->boc = $boc;
    }

    public function showConsent() {

        return $this->boc->showConsentScreen();
    }

    public function callback() {

        $this->boc->authorize();

        return redirect()->route('home');

    }
}
