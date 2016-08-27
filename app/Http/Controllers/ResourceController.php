<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class ResourceController extends Controller {
    
    use \App\BrowserTrait;
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
            return redirect()->route('page', ['section' => $section], '303')->with('uri', $resource);
        } else {
            Log::info('Log message', array('context' => 'It got on data'));
            return redirect()->route('data', ['section' => $section], '303')->with('uri', $resource);
        }
    }

    public function noResource() {
        $type = "You have not provided a valid resource. Please try again";
        return $type;
    }

    public function page(Request $request, $resource) {
        //get the url
        $uri = $request->session()->get('uri');
        if (!isset($uri)) {
            $uri = $request->getSchemeAndHttpHost() . '/resource' . '/' . urldecode($resource);
        }
        $graph = \EasyRdf_Graph::newAndLoad($uri);
        $label = $this->label($graph, $uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = $this->getNamedGraph($uri);
            $abstract = $this->resourceAbstract($graph, $uri);
            $literals = $this->getAllLiterals($graph, $uri);
            $resources = $this->getAllResources($graph, $uri);
            $reverseResources = $this->getAllReverseResources($graph, $uri);
            $images = $this->getAllImages($graph, $uri);
            $map = $this->getGEO($graph, $uri);
            return view('index', [
                'resource' => $resource,
                'graph' => $graph,
                'label' => $label,
                'uri' => $uri,
                'namedGraph' => $namedGraph,
                'abstract' => $abstract,
                'types' => $types,
                'literals' => $literals,
                'resources' => $resources,
                'reverseResources' => $reverseResources,
                'images' => $images,
                'map' => $map,
                'rewrite' => false,
            ]);
        } else {
            return view('errors.noResource', [
                'label'=> $label,
            ]);
        }
    }

    

    
    

    

    

    

    

    

    

    

}
