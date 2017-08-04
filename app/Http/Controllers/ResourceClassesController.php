<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResourceClass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ResourceClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $resourceclasses = ResourceClass::paginate(15);

        return view('resource-classes.index', compact('resourceclasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('resource-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        ResourceClass::create($request->all());

        Session::flash('flash_message', 'ResourceClass added!');

        return redirect('RDFBrowser/resource-classes');
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
        $resourceclass = ResourceClass::findOrFail($id);

        return view('resource-classes.show', compact('resourceclass'));
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
        $resourceclass = ResourceClass::findOrFail($id);

        return view('resource-classes.edit', compact('resourceclass'));
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
        
        $resourceclass = ResourceClass::findOrFail($id);
        $resourceclass->update($request->all());

        Session::flash('flash_message', 'ResourceClass updated!');

        return redirect('RDFBrowser/resource-classes');
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
        ResourceClass::destroy($id);

        Session::flash('flash_message', 'ResourceClass deleted!');

        return redirect('RDFBrowser/resource-classes');
    }
}
