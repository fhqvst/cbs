<?php

namespace App\Http\Controllers;

use App\Events\ViewInstrument;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Instrument;
use DB;

class InstrumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a list of the resources.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $instruments = Instrument::all();
        return view('market')
            ->with('instruments', $instruments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $instrument = Instrument::findOrFail($id);

        event(new ViewInstrument($id, $instrument->markets));
        return view('instrument')
            ->with('instrument', $instrument)
            ->with('instrument_meta', []);
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
