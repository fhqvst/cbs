<?php

namespace App\Http\Controllers;

use App\Services\Nordnet;

class NordnetController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $nordnet = new Nordnet('fhqvst', 'ib2KRor4');
        return $nordnet->getInstrumentList();
    }
}