<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $redirect = Redirect::paginate(15);

        return view('redirect.index', compact('redirect'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('redirect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Redirect::create($request->all());

        Session::flash('flash_message', 'Redirect added!');

        return redirect('RDFBrowser/redirect');
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
        $redirect = Redirect::findOrFail($id);

        return view('redirect.show', compact('redirect'));
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
        $redirect = Redirect::findOrFail($id);

        return view('redirect.edit', compact('redirect'));
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
        
        $redirect = Redirect::findOrFail($id);
        $redirect->update($request->all());

        Session::flash('flash_message', 'Redirect updated!');

        return redirect('RDFBrowser/redirect');
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
        Redirect::destroy($id);

        Session::flash('flash_message', 'Redirect deleted!');

        return redirect('RDFBrowser/redirect');
    }
}
