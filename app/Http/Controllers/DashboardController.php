<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info = bitcoind()->getInfo()->get();
        $balance = bitcoind()->getBalance()->get();
        return view('dashboard', [ 'info' => $info, 'faucetBalance' => $balance ] );
    }
}
