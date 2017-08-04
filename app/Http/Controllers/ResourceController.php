<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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
            $resourceClasses = \App\ResourceClass::where("enabled", "=", true)->get();
            $instances = $this->transformClass($resourceClasses);
            return view("landing.index", [
                "label" => "Browse RDF Resource Categories",
                "classes" => $instances,
            ]);
        }
        else{
            $redirect = env("APP_DOMAIN_REDIRECT");
            return redirect($redirect, 302);
        }

    }

    public function browse($id)
    {
        $class = \App\ResourceClass::findOrFail($id);
        $label = (new \EasyRdf_Resource($class->classUrl))->shorten()?: $class->classUrl;

        $this->setNamespaces();
        $endpoint = \App\Endpoint::first();
        $sparql = new \EasyRdf_Sparql_Client($endpoint->endpoint_url);
        $limit = (int) $class->pagination_size;
        $page = isset(request()->page) ? (int) request()->page : 1;
        $offset = isset(request()->page) ? (($page-1) * $limit) +1 : 1;
        $query = 'SELECT distinct ?resource ?label WHERE {?resource a <'. $class->classUrl .'> .'
                .'OPTIONAL {?resource rdfs:label ?label .}}'
                .'ORDER BY (?resource)'
                .'LIMIT '. $limit
                .'OFFSET ' . $offset;
        $query_count = 'SELECT (count(distinct *) as ?count) WHERE {?resource a <'. $class->classUrl .'> .'
                        .'OPTIONAL {?resource rdfs:label ?label .}}';
        $count = $sparql->query($query_count)[0]->count->getValue();
        //$total_pages_temp = intdiv($count,  $limit);
        //$last_page = ($count % $limit) === 0 ? $total_pages_temp : $total_pages_temp + 1;
        //$next = $page <= $last_page && $page >= 1 ? $page+1 : null;
        //$previous = $page >= 1 && $page !== null && $page <= $last_page ? $page-1: null;
        //$next_url = $next !== null ? env("APP_URL") . "/browse/" . $id . "?page=" . $next : null;
        //$previous_url = $previous !== null ? env("APP_URL") . "/browse/" . $id . "?page=" . $previous : null;
        //$from = $offset;
        //$to = $next === null ? $count : $offset + $limit;
        $result = $sparql->query($query);
        $instances = $this->transformResult($result);
        $paginator = new LengthAwarePaginator($instances,$count,$limit,$page, ["path" => "/browse/" . $id]);
        $view_elements = [
            "label" => $label,
            //"total" => $count,
            //"per_page" => $limit,
            //"current_page" => $page,
            //"last_page" => $last_page,
            //"next_page_url" => $next_url,
            //"prev_page_url" => $previous_url,
            //"from" => $from,
            //"to" => $to,
            "classes" => $instances,
            "paginator" => $paginator,
            //"query" => $query,
            //"count_query" => $query_count,
        ];
        return view('landing.index', $view_elements);
    }

    public function transformClass($classes){
        $result = collect();
        $this->setNamespaces();
        foreach($classes as $class){
            $element = new \stdClass();
            $element->title = (new \EasyRdf_Resource($class->classUrl))->shorten()?: $class->classUrl;
            $element->iri = env("APP_URL") . '/browse/' . $class->id;
            $element->description =  "No label";
            $result->push($element);
        }
        return $result;
    }

    public function transformResult($classes){
        $result = collect();
        $this->setNamespaces();
        foreach($classes as $class){
            $element = new \stdClass();
            $element->title = $class->resource->shorten()?: $class->resource->getUri();
            $element->iri = $class->resource->getUri();
            $element->description =  isset($class->label) ? $class->label->getValue() : "No label";
            $result->push($element);
        }
        return $result;
    }



    public function page(Request $request, $resource) {
        //get the url
        $uri = $request->session()->get('uri');
        if (!isset($uri)) {
            $uri = $this->constructIRI($request, $resource);
        }
        try {
            $graph = \EasyRdf_Graph::newAndLoad($uri);
        } catch (\EasyRdf_Http_Exception $ex) {
            return response()->view('errors.noResource', [
                'label'=> $uri,
            ], 404);
        }
        $this->setNamespaces();        
        $decoded_uri = rawurldecode($uri);
        $label = $this->label($graph, $decoded_uri);
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
    }

}