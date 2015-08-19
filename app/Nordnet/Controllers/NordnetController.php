<?php

namespace App\Nordnet\Controllers;

use App\Instrument;
use App\Market;
use App\Listing;
use App\Metadata;
use App\Http\Controllers\Controller;
use Cache;
use App\Nordnet\Contracts\NordnetContract as Nordnet;

class NordnetController extends Controller {


    public function __construct() {
        $this->middleware('auth');
    }

    public function getSynchronize(Nordnet $nordnet)
    {
        // Synchronize listings
        $listings = $nordnet->getListings();
        foreach($listings as $listing) {
            if(!Listing::firstOrCreate([
                'nordnet_id' => $listing->list_id,
                'name' => $listing->name
            ])) {
                return "An error occured";
            }
        }

        // Synchronize markets
        $markets = $nordnet->getMarkets();
        foreach($markets as $market) {
            if(!Market::firstOrCreate([
                'nordnet_id' => $market->market_id,
                'name' => $market->name
            ])) {
                return "An error occured";
            }
        }

        // Synchronize instruments
        $listings = array(
            "large_cap_stockholm" => 16314763
        );

        $markets = array(
            "nasdaq_omx_stockholm" => 11
        );

        // Loop through chosen list and fetch respective instruments
        foreach($listings as $listing) {

            $instruments = $nordnet->getInstruments($listing);
            foreach($instruments as $nn_instrument) {

                // Get correct market_id for instrument
                if(property_exists($nn_instrument, 'tradables')) {
                    foreach($nn_instrument->tradables as $tradable) {
                        if(in_array($tradable->market_id, $markets, true)) {
                            $market_id = Market::where('nordnet_id', $tradable->market_id)->first()->id;
                            break;
                        }
                    }
                }

                $instrument = Instrument::firstOrCreate([
                    'symbol' => $nn_instrument->symbol,
                    'name' => $nn_instrument->name,
                    'nordnet_id' => $nn_instrument->instrument_id,
                    'listing_id' => Listing::where('nordnet_id', $listing)->first()->id,
                ]);

                if(!$instrument) {
                    return "An error occured when inserting the instrument.";
                }

                // Add sector
                if(property_exists($nn_instrument, 'sector')) {
                    $sector = Metadata::firstOrCreate([
                        'key' => 'sector',
                        'value' => $nn_instrument->sector,
                        'logged_at' => date("Y-m-d H:i:s")
                    ]);
                    $instrument->metadata()->attach($sector->id);
                }

                // Add isin code
                if(property_exists($nn_instrument, 'isin_code')) {
                    $isin_code = Metadata::firstOrCreate([
                        'key' => 'isin_code',
                        'value' => $nn_instrument->isin_code,
                        'logged_at' => date("Y-m-d H:i:s")
                    ]);
                    $instrument->metadata()->attach($isin_code->id);
                }

            }

        }

        return "Synchronization succeeded :D";
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

    public function getInstruments(Nordnet $nordnet) {
        return $nordnet->getInstruments('16314763');
    }

    public function getLists(Nordnet $nordnet) {
        return $nordnet->getLists();
    }

    public function getMarkets(Nordnet $nordnet) {
        return $nordnet->getMarkets();
    }

    public function getQuotes(Nordnet $nordnet, $market_id, $instrument_id) {
        return $nordnet->getQuotes();
    }

    public function getBorsdata(Nordnet $nordnet) {
        return $nordnet->getBorsdata();
    }

    public function getKey() {
        return Cache::get('nordnet_session');
    }

}