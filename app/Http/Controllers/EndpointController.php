<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Endpoint;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use ARC2;

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
        return view('sparql', ["label" => "SPARQL Endpoint"]);
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

    public function endpointSetup() {
        
        $config = array(
            /* db */
            'db_host' => env('ARC2_ENDPOINT_HOST'), /* optional, default is localhost */
            'db_name' => env('ARC2_ENDPOINT_DATABASE'),
            'db_user' => env('ARC2_ENDPOINT_USERNAME'),
            'db_pwd' => env('ARC2_ENDPOINT_PASSWORD'),
            /* store name */
            'store_name' => env('ARC2_ENDPOINT_DATABASE'),
            /* endpoint */
            'endpoint_features' => array(
                'select',
                'construct',
                'ask',
                'describe',
                //'load',
                //'insert',
                //'delete',
                'dump' /* dump is a special command for streaming SPOG export */
            ),
            'endpoint_timeout' => 600, /* not implemented in ARC2 preview */
            'endpoint_read_key' => '', /* optional */
            'endpoint_write_key' => 'REPLACE_THIS_WITH_SOME_KEY', /* optional, but without one, everyone can write! */
            'endpoint_max_limit' => 1000000, /* optional */
            'max_errors' => 100,
            'store_strip_mb_comp_str' => true,
        );

        /* instantiation */
        $endpoint = \ARC2::getStoreEndpoint($config);
        if (!$endpoint->isSetUp()) {
            $endpoint->setUp(); /* create MySQL tables */
        }
        
        return $endpoint;
        
    }
    
    public function sparql2(){
        /* request handling */
        $endpoint = $this->endpointSetup();
        $endpoint->handleRequest(0);
        $headers = $endpoint->headers;
        $result = $endpoint->result;
        $length = strlen($result);
        foreach ($headers as $header){
            header($header);
        }
        header('Content-Length: ' . $length);
       
        echo $result;
        exit;
    }

}
