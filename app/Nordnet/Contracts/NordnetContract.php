<?php

namespace App\Nordnet\Contracts;

interface NordnetContract {
    public function getInstrument($instrument_id);
    public function getInstrumentList($market_id);
}