<?php

namespace App\Nordnet\Contracts;

interface NordnetContract {

    const MARKET_NASDAQ_OMX = 11;

    const LIST_NASDAQ_OMX_LARGE_CAP = 16314763;
    const LIST_NASDAQ_OMX_MID_CAP = 16314764;
    const LIST_NASDAQ_OMX_SMALL_CAP = 16314765;

    const MARKETS_TO_LISTS = array(
        NordnetContract::MARKET_NASDAQ_OMX => array(
            NordnetContract::LIST_NASDAQ_OMX_LARGE_CAP,
            NordnetContract::LIST_NASDAQ_OMX_MID_CAP,
            NordnetContract::LIST_NASDAQ_OMX_SMALL_CAP
        )
    );

    public function getInstrument($instrument_id);
    public function getInstruments($list_id);
}