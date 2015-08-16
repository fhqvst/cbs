<?php

namespace App\Http\Controllers\Market;

use App\Events\OrderCreated;
use Illuminate\Http\Request;

use App\Http\Requests;
use Redis;
use App\Order;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $redis = Redis::connection();
        $order_ranks = $redis->zRevRange('orders:' . $id, 0, -1);

        $orders = [];
        foreach($order_ranks as $order) {

            // Get hash keys and values
            $keys = $redis->hKeys('order:' . $order);
            $values = $redis->hVals('order:' . $order);

            // Combine them into an associative array
            $orders[] = array_combine($keys, $values);
        }

        return response($orders)
            ->header('Content-Type', 'application/json');
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
            'portfolio_id' => $request->user()->portfolio->id,
            'price' => $request->input('price'),
            'volume' => $request->input('volume'),
            'visible_volume' => $request->input('volume'),
            'side' => $request->input('side'),
            'expires_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'instrument_id' => $request->input('instrument_id'),
            'status' => '0',
            'queue_position' => 0,
            'type' => $request->input('type')
        );

        $order = Order::create($order);
        if($order) {

            // Put order id last in instrument order queue list
            $redis->zIncrBy('orders:' . $order->instrument_id, $order->price, $order->id);

            // Store the order as hash
            $redis->hMset('order:' . $order->id, $order->toArray());

            // Send an event to redis -> socket
            event(new OrderCreated($order));
        }
        return response(null, 200);
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
