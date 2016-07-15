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
        $priorities = array('application/rdf+xml', 'text/html', 'text/n3');
        $mediaType = $negotiator->getBest($header, $priorities);
       
        $type = $mediaType->getValue(); 
        
        $resource = $request->fullUrl();
        
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
        $graph = \EasyRdf_Graph::newAndLoad($url, 'rdfxml');
         //Log::info('Log message', array('context' => 'I am on page end'));
        echo $graph->dump('html');
    }

    public function data(Request $request, $resource) {
        // Setup some additional prefixes for DBpedia
        Log::info('Log message', array('context' => 'I am on data 0'));
        
        $sparql = new \EasyRdf_Sparql_Client('http://localhost:8890/sparql');
        
        Log::info('Log message', array('context' => 'I am on data 1'));
        
        $result = $sparql->query('Describe <http://localhost:8000/resource/1>');
        
        Log::info('Log message', array('context' => 'I am on data 2'));
        $content = $result->serialise('rdfxml');
        
        $length = strlen($content);
        
        Log::info('Log message', array('context' => 'I am on data 3'));

        //header('Content-Description: File Transfer');
        header('Connection: Keep-Alive');
        header('Accept-Ranges: bytes');
        header('Content-Type: application/rdf+xml'); //<<<<
        //header('Content-Disposition: attachment; filename=testfile.rdf');
        //header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . $length);
        //header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        //header('Expires: 0');
        //header('Pragma: public');
        
        Log::info('Log message', array('context' => 'I am on data 4'));
        
        echo $content;
        
        Log::info('Log message', array('context' => 'I am on data 5'));
        exit;
    }

}
