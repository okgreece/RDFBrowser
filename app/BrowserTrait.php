<?php

namespace App;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

trait BrowserTrait
{
    /*
     * Currently this works because of a hack in easyrdf library
     * I have created an issue but untill this get resolved we continue
     * using the hack on Namespace.php. I have commented out the lines where get
     * method checks for \W preg_match. When hyphens are included on the prefix,
     * these lines cause this method to fail when serializing graphs into files
     */
    public static function setNamespaces(){
        $namespaces = \App\rdfnamespace::where('added','=','1')->get();
        foreach ($namespaces as $namespace){
            \EasyRdf_Namespace::set($namespace->prefix, $namespace->uri);
        }
        return;
    }
    
    public static function uknownNamespace($uri){
        $tempnamespace = new \EasyRdf_Resource($uri);
        $local = $tempnamespace->localName();        
        $namespace = mb_substr($uri, 0, -mb_strlen($local));
        $existing = \App\rdfnamespace::where('uri', '=', $namespace)->get();
        try{
            if($existing->isEmpty()){
                \App\rdfnamespace::create(['prefix'=>'null',
                                    'uri'=>$namespace,
                                    'added'=> 0
                                    ]);
            }
        } catch (\Exception $ex) {
            logger($ex);
        }        
        return $uri;
    }
    
    public static function constructIRI($request, $resource){
            $route = $request->route()->getName();
            
            if($route == 'page'){
             $path = 'resource';
            }
            else if($route == 'page2'){
                $path = 'ontology';
            }
            $uri = $request->getSchemeAndHttpHost() . '/' . $path . '/' . $resource;
            return $uri;
    }
    
    public static function encode_iri($iri) {
        $dirname = BrowserTrait::dirname($iri);
        //the following is needed in order to work with IRIs
        $local = mb_substr($iri, mb_strlen($dirname));
        //$local = pathinfo($iri, PATHINFO_BASENAME);
        $filename = rawurlencode($local);
        $encoded_uri = $dirname . $filename;
        return $encoded_uri;
    }
    
    public static function dirname($iri){
        
        if (pathinfo($iri, PATHINFO_DIRNAME) != ".") {
            $dirname = pathinfo($iri, PATHINFO_DIRNAME) . '/';
        }
        else {
            $dirname = "";
        }
        return $dirname;        
    }
    
    //code taken by https://stackoverflow.com/users/1691517/timo-k%c3%a4hk%c3%b6nen on
    //https://stackoverflow.com/questions/4451664/make-php-pathinfo-return-the-correct-filename-if-the-filename-is-utf-8
    function mb_basename($path) {
        $separator = " qq ";
        $path = preg_replace("/[^ ]/u", $separator . "\$0" . $separator, $path);
        $base = basename($path);
        $base = str_replace($separator, "", $base);
        return $base;
    }

    function mb_pathinfo($path, $opt = "") {
        $separator = " qq ";
        $path = preg_replace("/[^ ]/u", $separator . "\$0" . $separator, $path);
        if ($opt == "")
            $pathinfo = pathinfo($path);
        else
            $pathinfo = pathinfo($path, $opt);

        if (is_array($pathinfo)) {
            $pathinfo2 = $pathinfo;
            foreach ($pathinfo2 as $key => $val) {
                $pathinfo[$key] = str_replace($separator, "", $val);
            }
        } else if (is_string($pathinfo))
            $pathinfo = str_replace($separator, "", $pathinfo);
        return $pathinfo;
    }
    
    public static function constructIRI2($request, $resource){
            $route = $request->route()->getName();
            
            if($route == 'data'){
             $path = 'resource';
            }
            else if($route == 'data2'){
                $path = 'ontology';
            }
            $uri = $request->getSchemeAndHttpHost() . '/' . $path . '/' . $resource;
            return $uri;
    }
    
    /* function to get the label of a resource based on 4 rules by priority:
     * 1)Get the browser locale setting and request this language
     * 2)Get the label for the default language set
     * 3)Get any label in any language
     * 4)Return the IRI as a string to use for label
     * 
     */
    public static function label(\EasyRdf_Graph $graph, $uri) {
        $label_properties = 
                \App\LabelExtractor::where('enabled','=', '1')
                ->orderBy('priority','asc')
                ->get();
        $label = null;
        $locale = Cookie::get('locale');
        foreach ($label_properties as $property) {
            if ($label == null) {
                $label = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property),
                                $locale
                                );
            } else {
                break;
            }
            if ($label == null) {
                //get default label in English. This should be configurable on .env
                $label = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property),
                                'en'
                                );
            }
            if ($label == null) {
                //if no english label found try a label in any language
                $label = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property)
                                );
            }
        }
        if($label == null){
            $label = $uri;
        }
        return $label;
    }
    
    public static function resourceAbstract(\EasyRdf_Graph $graph, $uri) {
        $abstract_properties = 
                \App\AbstractExtractor::where('enabled','=', '1')
                ->orderBy('priority','asc')
                ->get();
        $abstract = null;
        $locale = Cookie::get('locale');
        foreach ($abstract_properties as $property) {
            if ($abstract == null) {
                $abstract = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property),
                                $locale
                                );
            } else {
                break;
            }
            if ($abstract == null) {
                //get default label in English. This should be configurable on .env
                $abstract = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property),
                                'en'
                                );
            }
            if ($abstract == null) {
                //if no english label found try a label in any language
                $abstract = $graph
                        ->getLiteral(
                                $uri,
                                new \EasyRdf_Resource($property->property)
                                );
            }
        }
        return $abstract;
    }
    
    
    public function getNamedGraph($resource) {

        $endpoint = \App\Endpoint::first();

        $sparql = new \EasyRdf_Sparql_Client($endpoint->endpoint_url);
        
        $result = $sparql->query('select distinct ?g where {Graph ?g {<' . rawurldecode($resource) . '> ?p ?o}}');
        
        $response = isset($result[0]) ? $result[0]->g : "none"; 
        return $response;
        
    }
    
    public function getAllLiteralsOld(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->propertyUris($resource);
        $literals = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $literalValues = $graph->allLiterals($resource, new \EasyRdf_Resource($property));
                if (!empty($literalValues)) {
                    $element = ['property' => $property,
                        'values' => $literalValues];
                    array_push($literals, $element);
                }
            } catch (\Exception $ex) {
                $element = ['property' => $property,
                    'values' => "Fault found: "];
                array_push($literals, $element);
            }
        }
        return $literals;
    }
    
    public function getAllLiterals(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->propertyUris($resource);
        $resources = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $resourceValues = $graph->allLiterals($resource, new \EasyRdf_Resource($property));
                if (!empty($resourceValues)) {
                    $values = [];
                    foreach($resourceValues as $resourceValue){
                        $dataType = $resourceValue->getDatatypeUri();
                        $value = $resourceValue->getValue();
                        $lang = $resourceValue->getLang();
                        array_push($values, ["type" => "literal", "value" => $value, "lang" => $lang, "datatype" => $dataType]);
                    }
                    $element = ['property' => $property,
                        'values' => $values];
                    array_push($resources, $element);
                }
            } catch (\Exception $ex) {
                $element = ['property' => $property,
                    'values' => "Fault found: "];
                array_push($resources, $element);
            }
        }
        return $resources;
    }
    
    public function getAllResources(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->propertyUris($resource);
        $resources = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $resourceValues = $graph->allResources($resource, new \EasyRdf_Resource($property));
                if (!empty($resourceValues)) {
                    $values = [];
                    foreach($resourceValues as $resourceValue){
                        $type = $resourceValue->isBNode() ? "bnode" : "resource";
                        $value = $resourceValue->isBNode() ? $resourceValue->getBNodeId() : $resourceValue->getUri();
                        array_push($values, ["type" => $type, "value" => $value]);
                    }
                    $element = ['property' => $property,
                        'values' => $values];
                    array_push($resources, $element);
                }
            } catch (\Exception $ex) {
                $element = ['property' => $property,
                    'values' => "Fault found: "];
                array_push($resources, $element);
            }
        }
        return $resources;
    }
    
    public static function getBNodeDescription(\EasyRdf_Graph $graph, $bnodeID) {
        $resource = $graph->resource("_:". $bnodeID);
        //dd($graph->dump($resource));
        $description = [];
        $bnode_properties = $graph->propertyUris($resource);
        foreach($bnode_properties as $property){
            $values = $graph->all($resource, new \EasyRdf_Resource($property));
            array_push($description, 
                    [
                        'property' => $property, 
                        'value' => $values
                    ]
                    );                        
            }
                
        return view('layouts.browser_partials.content.popover', ["descriptions" => $description]);
    }
    
    public function getAllReverseResources(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->reversePropertyUris($resource);
        $resources = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $resourceValues = $graph->allResources($resource, new \EasyRdf_Resource('^'. $property));
                if (!empty($resourceValues)) {
                    $values = [];
                    foreach($resourceValues as $resourceValue){
                        $type = $resourceValue->isBNode() ? "bnode" : "resource";
                        $value = $resourceValue->isBNode() ? $resourceValue->getBNodeId() : $resourceValue->getUri();
                        array_push($values, ["type" => $type, "value" => $value]);
                    }
                    $element = ['property' => $property,
                        'values' => $values];
                    array_push($resources, $element);
                }
            } catch (\Exception $ex) {
                $element = ['property' => $property,
                    'values' => "Fault found: "];
                array_push($resources, $element);
            }
        }
        return $resources;
    }
    
    public function getAllImages(\EasyRdf_Graph $graph, $uri) {
        $image_properties = 
                \App\ImageExtractor::where('enabled','=','1')
                ->orderBy('priority','asc')
                ->get();
        $images = [];
        foreach ($image_properties as $property) {
            $image = $graph->getResource($uri, new \EasyRdf_Resource($property->property));
            if (isset($image)) {
                array_push($images, $image);
            }
        }
        return $images;
    }
    
    public function getGEO(\EasyRdf_Graph $graph, $uri) {
        $extractors = \App\GeoExtractor::where('enabled', '1')->orderBy('order', 'asc')->get();

        foreach ($extractors as $extractor) {
            if ($extractor->type == 'dual') {
                $data = $this->dualExtractor($graph, $uri, $extractor);
            } else {
                $data = $this->singleExtractor($graph, $uri, $extractor);
            }
            if ($data != null) {
                break;
            }
        }
        return $data;
    }
    
    public function dualExtractor(\EasyRdf_Graph $graph, $resource, \App\GeoExtractor $extractor) {
        $latitudeProperty = new \EasyRdf_Resource($extractor->lat);
        $latitude = $graph->get($resource, $latitudeProperty);

        $longtitudeProperty = new \EasyRdf_Resource($extractor->long);
        $longtitude = $graph->get($resource, $longtitudeProperty);
        if ($latitude != null && $longtitude != null) {
            $data = '[' . $latitude . ', ' . $longtitude . ']';
        } else {
            $data = null;
        }
        return $data;
    }
    
    public function singleExtractor(\EasyRdf_Graph $graph, $resource, \App\GeoExtractor $extractor) {
        $geoProperty = new \EasyRdf_Resource($extractor->generic);
        $geo = $graph->get($resource, $geoProperty);
        if($geo == null){
            return $data = null;
        }
        $regex = $extractor->genericFormat;
        $matches = [];
        preg_match($regex, $geo->getValue(), $matches);
        $latitude = $matches[$extractor->lat];
        $longtitude = $matches[$extractor->long];
        if ($latitude != null && $longtitude != null) {
            $data = '[' . $latitude . ', ' . $longtitude . ']';
        } else {
            $data = null;
        }
        return $data;
    }
}
