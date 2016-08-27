<?php

namespace App;

use Illuminate\Support\Facades\Cookie;

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
        return 0;
    }
    
    public static function uknownNamespace($uri){
        $tempnamespace = new \EasyRdf_Resource($uri);
        $local = $tempnamespace->localName();
        
        $namespace = mb_substr($uri, 0, -mb_strlen($local));
        $existing = \App\rdfnamespace::where('uri', '=', $namespace)->get();
        if($existing->isEmpty()){
            \App\rdfnamespace::create(['prefix'=>'null',
                                    'uri'=>$namespace,
                                    'added'=> 0
                                    ]);
        }
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

        $endpoint = \App\Endpoint::all();

        $sparql = new \EasyRdf_Sparql_Client($endpoint[0]->endpoint_url);

        $result = $sparql->query('select distinct ?g where {Graph ?g {<' . $resource . '> ?p ?o}}');

        return $result[0]->g;
    }
    
    public function getAllLiterals(\EasyRdf_Graph $graph, $resource) {
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
    
    public function getAllResources(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->propertyUris($resource);
        $resources = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $resourceValues = $graph->allResources($resource, new \EasyRdf_Resource($property));
                if (!empty($resourceValues)) {
                    $element = ['property' => $property,
                        'values' => $resourceValues];
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
    
    public function getAllReverseResources(\EasyRdf_Graph $graph, $resource) {
        $properties = $graph->reversePropertyUris($resource);

        $resources = array();
        $element = array();
        foreach ($properties as $property) {
            try {
                $reverseProperty = '^' . $property;
                $resourceValues = $graph->allResources($resource, new \EasyRdf_Resource($reverseProperty));
                if (!empty($resourceValues)) {
                    $element = ['property' => $property,
                        'values' => $resourceValues];
                    array_push($resources, $element);
                }
            } catch (\Exception $ex) {
                $element = ['property' => $reverseProperty,
                    'values' => "Fault found: " . $ex];
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
