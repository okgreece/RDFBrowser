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
        //$type = "You have not provided a valid resource. Please try again";
        if(env("APP_DOMAIN_PAGE")){
            return view("landing.index", [
                "label" => "Label"
            ]);
        }
        else{
            $redirect = env("APP_DOMAIN_REDIRECT");
            return redirect($redirect, 302);
        }
        
    }
    
    

    public function page(Request $request, $resource) {
        //get the url
        $uri = $request->session()->get('uri');
        if (!isset($uri)) {
            
            $uri = $this->constructIRI($request, $resource);
            $graph = \EasyRdf_Graph::newAndLoad($uri);
        }
        else{
            
            $graph = \EasyRdf_Graph::newAndLoad($uri);
        }
        $this->setNamespaces();        
        $decoded_uri = rawurldecode($uri);
        $label = $this->label($graph, $decoded_uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = $this->getNamedGraph($uri);
            $abstract = $this->resourceAbstract($graph, $uri);
            $images = $this->getAllImages($graph, $uri);
            $map = $this->getGEO($graph, $uri);
            return view('index', [
                'resource' => $uri,
                'label' => $label,
                'uri' => $uri,
                'uriPart' => $resource,
                'namedGraph' => $namedGraph,
                'abstract' => $abstract,
                'types' => $types,
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