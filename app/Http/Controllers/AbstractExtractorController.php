<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AbstractExtractor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AbstractExtractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $abstractextractor = AbstractExtractor::paginate(15);

        return view('abstract-extractor.index', compact('abstractextractor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('abstract-extractor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        AbstractExtractor::create($request->all());

        Session::flash('flash_message', 'AbstractExtractor added!');

        return redirect('RDFBrowser/abstract-extractor');
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
        $abstractextractor = AbstractExtractor::findOrFail($id);

        return view('abstract-extractor.show', compact('abstractextractor'));
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
        $abstractextractor = AbstractExtractor::findOrFail($id);

        return view('abstract-extractor.edit', compact('abstractextractor'));
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
        
        $abstractextractor = AbstractExtractor::findOrFail($id);
        $abstractextractor->update($request->all());

        Session::flash('flash_message', 'AbstractExtractor updated!');

        return redirect('RDFBrowser/abstract-extractor');
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
        AbstractExtractor::destroy($id);

        Session::flash('flash_message', 'AbstractExtractor deleted!');

        return redirect('RDFBrowser/abstract-extractor');
    }
}
