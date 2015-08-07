<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;

use Redis;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $redis = Redis::connection();
        $orders = $redis->lRange('order:1337', 0, -1);

        $orders = array_map(function($order) {
            $order = json_decode($order);
            $order->instrument = Instrument::find($order->instrument)->first();
            return $order;

        }, $orders);

        return view('dashboard')
            ->with('instruments', Instrument::all())
            ->with('portfolio', $request->user()->portfolio)
            ->with('orders', $orders);
    }
}
