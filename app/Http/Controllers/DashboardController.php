<?php

namespace App\Http\Controllers;

use App\Instrument;

class DashboardController extends Controller
{

    public function __construct() {
    }

    public function index()
    {
        return view('dashboard')
            ->with('instruments', Instrument::all());
    }
}
