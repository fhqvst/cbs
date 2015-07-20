<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Instrument;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard')
            ->with('instruments', Instrument::all())
            ->with('nordnet', array());
    }
}
