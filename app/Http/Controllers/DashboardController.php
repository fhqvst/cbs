<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        $portfolio = $request->user()->portfolio;

        return view('dashboard')
            ->with('instruments', Instrument::all())
            ->with('portfolio', $portfolio);
    }
}
