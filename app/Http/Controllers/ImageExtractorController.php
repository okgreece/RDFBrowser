<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ImageExtractor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ImageExtractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $imageextractor = ImageExtractor::paginate(15);

        return view('image-extractor.index', compact('imageextractor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('image-extractor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        ImageExtractor::create($request->all());

        Session::flash('flash_message', 'ImageExtractor added!');

        return redirect('RDFBrowser/image-extractor');
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
        $imageextractor = ImageExtractor::findOrFail($id);

        return view('image-extractor.show', compact('imageextractor'));
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
        $imageextractor = ImageExtractor::findOrFail($id);

        return view('image-extractor.edit', compact('imageextractor'));
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
        
        $imageextractor = ImageExtractor::findOrFail($id);
        $imageextractor->update($request->all());

        Session::flash('flash_message', 'ImageExtractor updated!');

        return redirect('RDFBrowser/image-extractor');
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
        ImageExtractor::destroy($id);

        Session::flash('flash_message', 'ImageExtractor deleted!');

        return redirect('RDFBrowser/image-extractor');
    }
}
