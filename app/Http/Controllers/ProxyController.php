<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proxy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $proxy = Proxy::paginate(15);

        return view('proxy.index', compact('proxy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('proxy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Proxy::create($request->all());

        Session::flash('flash_message', 'Proxy added!');

        return redirect('RDFBrowser/proxy');
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
        $proxy = Proxy::findOrFail($id);

        return view('proxy.show', compact('proxy'));
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
        $proxy = Proxy::findOrFail($id);

        return view('proxy.edit', compact('proxy'));
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
        
        $proxy = Proxy::findOrFail($id);
        $proxy->update($request->all());

        Session::flash('flash_message', 'Proxy updated!');

        return redirect('RDFBrowser/proxy');
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
        Proxy::destroy($id);

        Session::flash('flash_message', 'Proxy deleted!');

        return redirect('RDFBrowser/proxy');
    }

    public function proxy(Request $request, $name){
        $proxy = Proxy::findOrFail($name);
        $client = new Client();

        $path = "/" . implode("/", array_slice($request->segments(),2));
        $result = $client->get($proxy->url . $path, [
            'query' => $request->query->all()
        ]);

        $this->send($result);
    }

    function send( Response $response)
    {
        $http_line = sprintf('HTTP/%s %s %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );
        header($http_line, true, $response->getStatusCode());
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header("$name: $value", false);
            }
        }
        $stream = $response->getBody();
        if ($stream->isSeekable()) {
            $stream->rewind();
        }
        while (!$stream->eof()) {
            echo $stream->read(1024 * 8);
        }
    }
}
