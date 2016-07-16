<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class ResourceController extends Controller {

    //
    public function negotiation(Request $request, $section) {

        $negotiator = new \Negotiation\Negotiator();
        $header = $request->header('Accept');
        $priorities = array('application/rdf+xml', 'text/html', 'text/n3', 'application/ld+json', 'text/turtle', 'application/rdf+json', 'application/n-triples');
        $mediaType = $negotiator->getBest($header, $priorities);
       
        $type = $mediaType->getValue(); 
        
        $resource = $request->fullUrl();
        Log::info('Log message', array('context' => $resource));
        Log::info('Log message', array('context' => $type));
        
        if ($type === 'text/html') {
            return redirect()->route('page', ['section' => $section], '303')->with('url', $resource);
            
        } else {
            Log::info('Log message', array('context' => 'It got on data')); 
            return redirect()->route('data', ['section' => $section], '303')->with('url', $resource);
        }
    }

    public function noResource() {
        $type = "You have not provided a valid resource. Please try again";
        dd($type);
    }

    public function browser(Request $request) {
        $url = $request->input('url');
    }

    public function page(Request $request, $resource) {
        //get the url
        $url = $request->session()->get('url');
       
        if(!isset($url)){
            $url = $request->getSchemeAndHttpHost() . '/resource' . '/' . $resource;
        }
        //$url = 'http://localhost/resource/1';
        //Log::info('Log message', array('context' => 'I am on page start'));
        $graph = \EasyRdf_Graph::newAndLoad($url,'jsonld');
         //Log::info('Log message', array('context' => 'I am on page end'));
        echo $graph->dump('html');
    }

    

}
