<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Graph;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class GraphsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $graphs = Graph::paginate(15);

        return view('graphs.index', compact('graphs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('graphs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Graph::create($request->all());

        Session::flash('flash_message', 'Graph added!');

        return redirect('graphs');
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
        $graph = Graph::findOrFail($id);

        return view('graphs.show', compact('graph'));
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
        $graph = Graph::findOrFail($id);

        return view('graphs.edit', compact('graph'));
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
        
        $graph = Graph::findOrFail($id);
        $graph->update($request->all());

        Session::flash('flash_message', 'Graph updated!');

        return redirect('graphs');
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
        Graph::destroy($id);

        Session::flash('flash_message', 'Graph deleted!');

        return redirect('graphs');
    }
}
