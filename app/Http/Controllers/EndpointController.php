<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Endpoint;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class EndpointController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index() {
        $endpoint = Endpoint::paginate(15);

        return view('endpoint.index', compact('endpoint'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {
        return view('endpoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request) {

        Endpoint::create($request->all());

        Session::flash('flash_message', 'Endpoint added!');

        return redirect('RDFBrowser/endpoint');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id) {
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
    public function edit($id) {
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
    public function update($id, Request $request) {

        $endpoint = Endpoint::findOrFail($id);
        $endpoint->update($request->all());

        Session::flash('flash_message', 'Endpoint updated!');

        return redirect('RDFBrowser/endpoint');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id) {
        Endpoint::destroy($id);

        Session::flash('flash_message', 'Endpoint deleted!');

        return redirect('RDFBrowser/endpoint');
    }

    public function sparql() {
        return view('sparql');
    }

    public function result() {
        if (isset($_REQUEST['endpoint']) and isset($_REQUEST['query'])) {
            $sparql = new \EasyRdf_Sparql_Client($_REQUEST['endpoint']);
            try {
                $results = $sparql->query($_REQUEST['query']);
                if (isset($_REQUEST['text'])) {
                    print "<pre>" . htmlspecialchars($results->dump('text')) . "</pre>";
                } else {
                    print $results->dump('html');
                }
            } catch (Exception $e) {
                print "<div class='error'>" . $e->getMessage() . "</div>\n";
            }
        }
    }

}
