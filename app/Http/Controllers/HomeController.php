<?php

namespace App\Http\Controllers;

use App\Services\OpenCorporates;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * @var OpenCorporates
     */
    //    private $openCorporates;

    /**
     * Create a new controller instance.
     *
     * //     * @param OpenCorporates $openCorporates
     */
    public function __construct() {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {


        return view('home');
    }
}
