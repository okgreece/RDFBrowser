<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

use Yajra\Datatables\Datatables;

class BrowserController extends Controller
{
    use \App\BrowserTrait;
    
    public function browser(Request $request) {
        $uri = $request->input('uri');
        $encoded_uri = $this->encode_iri($uri);
        $this->setNamespaces();        
        $graph = Cache::get($encoded_uri) ? : $this->cacheGraph($encoded_uri);
        $label = $this->label($graph, $uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = null;
            $abstract = $this->resourceAbstract($graph, $uri);
            $images = $this->getAllImages($graph, $uri);
            $map = $this->getGEO($graph, $uri);
            return view('index', [
                'resource' => $uri,
                'label' => $label,
                'uri' => $uri,
                'namedGraph' => $namedGraph,
                'abstract' => $abstract,
                'types' => $types,
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
    
    public function getLabel(Request $request)
    {
        $uri = explode("?uri=", $request->get("uri"));
        $encoded_uri = $this->encode_iri($uri[1]);
        $this->setNamespaces();
        $graph = \EasyRdf_Graph::newAndLoad($encoded_uri);
        $label = $this->label($graph, $uri);
        return $label;
    }
       
    public function resources() {
        $this->setNamespaces();   
        $resource = request()->resource;
        
        $graph = Cache::get($resource) ? : $this->cacheGraph($resource); 
        session()->put("resource", urldecode($resource));
        $values = collect($this->getAllResources($graph, urldecode($resource)));      
        return Datatables::of($values)
                        ->addColumn('property', function($value) {                            
                            return view('layouts.browser_partials.templates.property', 
                                    [
                                        "property" => $value["property"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                        "reversed" => false
                                    ]
                                    );
                        })
                        ->addColumn('value', function($value) {
                            return view('layouts.browser_partials.templates.values', 
                                    [
                                        "values" => $value["values"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                    ]
                                    );
                        })
//                        ->addColumn('action', function($link) {
//                            return  '<button onclick="delete_link('.$link->id.')" class="btn" title="Delete this Link"><span class="glyphicon glyphicon-remove text-red"></span></button>';
//                                   
//                        })
                        ->make(true);
    }
    
    public function reverseResources() {
        $this->setNamespaces();   
        $resource = request()->resource;
        $graph = Cache::get($resource) ? : $this->cacheGraph($resource);        
        session()->put("resource", urldecode($resource));
        $values = collect($this->getAllReverseResources($graph, urldecode($resource)));      
        return Datatables::of($values)
                        ->addColumn('property', function($value) {                            
                            return view('layouts.browser_partials.templates.property', 
                                    [
                                        "property" => $value["property"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                        "reversed" => true
                                    ]
                                    );
                        })
                        ->addColumn('value', function($value) {
                            return view('layouts.browser_partials.templates.values', 
                                    [
                                        "values" => $value["values"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                    ]
                                    );
                        })
//                        ->addColumn('action', function($link) {
//                            return  '<button onclick="delete_link('.$link->id.')" class="btn" title="Delete this Link"><span class="glyphicon glyphicon-remove text-red"></span></button>';
//                                   
//                        })
                        ->make(true);
    }
    
    public function literals() {
        $this->setNamespaces();   
        $resource = request()->resource;
        $graph = Cache::get($resource) ? : $this->cacheGraph($resource);        
        session()->put("resource", urldecode($resource));
        $values = collect($this->getAllLiterals($graph, urldecode($resource)));      
        return Datatables::of($values)
                        ->addColumn('property', function($value) {                            
                            return view('layouts.browser_partials.templates.property', 
                                    [
                                        "property" => $value["property"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                        "reversed" => false
                                    ]
                                    );
                        })
                        ->addColumn('value', function($value) {
                            return view('layouts.browser_partials.templates.values', 
                                    [
                                        "values" => $value["values"],
                                        "rewrite" => filter_var(request()->rewrite , FILTER_VALIDATE_BOOLEAN),
                                    ]
                                    );
                        })
//                        ->addColumn('action', function($link) {
//                            return  '<button onclick="delete_link('.$link->id.')" class="btn" title="Delete this Link"><span class="glyphicon glyphicon-remove text-red"></span></button>';
//                                   
//                        })
                        ->make(true);
    }

    public function cacheGraph($uri){
        $graph = \EasyRdf_Graph::newAndLoad($uri);
        Cache::put($uri, $graph, 10);
        return $graph;
    }
}
