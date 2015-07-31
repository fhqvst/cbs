<?php

namespace App\Nordnet\Controllers;

use App\Instrument;
use App\Http\Controllers\Controller;
use Cache;
use App\Nordnet\Contracts\NordnetContract as Nordnet;

class NordnetController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getSynchronize(Nordnet $nordnet)
    {
        $results = $nordnet->getInstrumentList(16314763);

        foreach($results as $result) {
            if(!Instrument::firstOrCreate([
                'symbol' => $result->symbol,
                'name' => $result->name,
                'label' => $result->name,
                'nordnet_id' => $result->instrument_id,
                'market_id' => property_exists($result, 'tradables') ? $result->tradables[0]->market_id : 0,
                'sector' => property_exists($result, 'sector') ? $result->sector : '',
                'isin_code' => property_exists($result, 'isin_code') ? $result->isin_code : ''
            ])) {
                return "An error occured";
            };
        }
        return response()->json(Instrument::all());

    }

    public function getUpdate($instrument_id, Nordnet $nordnet) {

        $instrument = Instrument::where('nordnet_id', $instrument_id)->first();
        $updated = $nordnet->getInstrument($instrument_id);

        if(is_array($updated)) {
            $updated = $updated[0];
        }

        if(isset($instrument) && $instrument->update(array(
                'symbol' => $updated->symbol,
                'name' => $updated->name,
                'label' => $updated->name,
                'nordnet_id' => $updated->instrument_id,
                'market_id' => property_exists($updated, 'tradables') ? $updated->tradables[0]->market_id : 0,
                'sector' => property_exists($updated, 'sector') ? $updated->sector : '',
                'isin_code' => property_exists($updated, 'isin_code') ? $updated->isin_code : ''
            )
        )) {
            return Instrument::where('nordnet_id', $instrument_id)->first();
        }
        return "{}";
    }

    public function getTradables($identifier, Nordnet $nordnet) {
        return $nordnet->getTradables($identifier);
    }

    public function getOrders($instrument_id, Nordnet $nordnet) {
        return $nordnet->getOrders($instrument_id);
    }

    public function getLogin(Nordnet $nordnet) {
        return $nordnet->authenticate();
    }

    public function getVolvo(Nordnet $nordnet) {
        return $nordnet->getVolvo();
    }

    public function getKey() {
        return Cache::get('nordnet_session');
    }

}