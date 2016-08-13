<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GeoExtractor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class GeoExtractorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $geoextractor = GeoExtractor::paginate(15);

        return view('geo-extractor.index', compact('geoextractor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('geo-extractor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'type' => 'required', 'order' => 'required', ]);

        GeoExtractor::create($request->all());

        Session::flash('flash_message', 'GeoExtractor added!');

        return redirect('geo-extractor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $geoextractor = GeoExtractor::findOrFail($id);

        return view('geo-extractor.show', compact('geoextractor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $geoextractor = GeoExtractor::findOrFail($id);

        return view('geo-extractor.edit', compact('geoextractor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['title' => 'required', 'type' => 'required', 'order' => 'required', ]);

        $geoextractor = GeoExtractor::findOrFail($id);
        $geoextractor->update($request->all());

        Session::flash('flash_message', 'GeoExtractor updated!');

        return redirect('geo-extractor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        GeoExtractor::destroy($id);

        Session::flash('flash_message', 'GeoExtractor deleted!');

        return redirect('geo-extractor');
    }
    
}
