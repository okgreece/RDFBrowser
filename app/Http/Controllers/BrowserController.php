<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrowserController extends Controller
{
    use \App\BrowserTrait;
    
    public function browser(Request $request) {
        $uri = $request->input('uri');
        
        $this->setNamespaces();
        
        $graph = \EasyRdf_Graph::newAndLoad($uri);
        
        $label = $this->label($graph, $uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = null;
            $abstract = $this->resourceAbstract($graph, $uri);
            $literals = $this->getAllLiterals($graph, $uri);
            $resources = $this->getAllResources($graph, $uri);
            $reverseResources = $this->getAllReverseResources($graph, $uri);
            $images = $this->getAllImages($graph, $uri);
            $map = $this->getGEO($graph, $uri);
            return view('index', [
                'resource' => $uri,
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
                'rewrite' => true,
            ]);
        } else {
            return view('errors.noResource', [
                'label'=> $label,
            ]);
        }
    }
}
