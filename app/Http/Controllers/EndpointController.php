<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Endpoint;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class EndpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $endpoint = Endpoint::paginate(15);

        return view('endpoint.index', compact('endpoint'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('endpoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Endpoint::create($request->all());

        Session::flash('flash_message', 'Endpoint added!');

        return redirect('endpoint');
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
        $endpoint = Endpoint::findOrFail($id);

        return view('endpoint.show', compact('endpoint'));
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
        $endpoint = Endpoint::findOrFail($id);

        return view('endpoint.edit', compact('endpoint'));
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
        
        $endpoint = Endpoint::findOrFail($id);
        $endpoint->update($request->all());

        Session::flash('flash_message', 'Endpoint updated!');

        return redirect('endpoint');
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
        Endpoint::destroy($id);

        Session::flash('flash_message', 'Endpoint deleted!');

        return redirect('endpoint');
    }
}
