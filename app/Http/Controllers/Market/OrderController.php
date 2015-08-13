<?php

namespace App\Http\Controllers\Market;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redis;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Get Redis instance
        $redis = Redis::connection();

        // Create order parameters
        $order = array(
            'portfolio' => $request->user()->portfolio(),
            'price' => $request->input('price'),
            'volume' => $request->input('volume'),
            'visible_volume' => $request->input('volume'),
            'side' => $request->input('side'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'instrument' => $request->input('instrument'),
            'status' => 'ON_MARKET',
            'type' => $request->input('type')
        );
        $order_id = $redis->incr('order:id => 1000');

        return $redis->lPush('order:1337', json_encode($order));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
