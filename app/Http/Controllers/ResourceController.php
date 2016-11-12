<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller {
    
    use \App\BrowserTrait;
    //
    public function negotiation(Request $request, $section) {

        $resource = $request->fullUrl();
        
        $negotiator = new \Negotiation\Negotiator();
        $header = $request->header('Accept');
        $priorities = array('application/rdf+xml', 'text/html', 'text/n3', 'application/ld+json', 'text/turtle', 'application/rdf+json', 'application/n-triples');
        $mediaType = $negotiator->getBest($header, $priorities);

        $type = $mediaType->getValue();
        
        if ($request->is('resource/*')) {
            $page = 'page';
            $data = 'data';
        }
        else if ($request->is('ontology/*')) {
            $page = 'page2';
            $data = 'data2';
        }
       
        if ($type === 'text/html') {
            return redirect()->route($page, ['section' => $section], '303')->with(['uri'=> $resource]);
        } else {
            return redirect()->route($data, ['section' => $section], '303')->with(['uri'=> $resource]);
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
            
            $uri = $this->constructIRI($request, $resource);
            $graph = \EasyRdf_Graph::newAndLoad($uri);
        }
        else{
            logger($uri);
            $graph = \EasyRdf_Graph::newAndLoad($uri);
        }
        
        $this->setNamespaces();        
        $uri = rawurldecode($uri);
        $label = $this->label($graph, $uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = $this->getNamedGraph($uri);
            $abstract = $this->resourceAbstract($graph, $uri);
            $literals = $this->getAllLiterals($graph, $uri);
            $resources = $this->getAllResources($graph, $uri);
            $reverseResources = $this->getAllReverseResources($graph, $uri);
            $bnodes = $this->getAllBNodes($graph);
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
                'bnodes' => $bnodes,
                'rewrite' => false,
            ]);
        } else {
            return view('errors.noResource', [
                'label'=> $label,
            ]);
        }
    }

}