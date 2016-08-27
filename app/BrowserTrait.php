<?php

namespace App;

use Illuminate\Support\Facades\Cookie;

trait BrowserTrait
{
    /* function to get the label of a resource based on 4 rules by priority:
     * 1)Get the browser locale setting and request this language
     * 2)Get the label for the default language set
     * 3)Get any label in any language
     * 4)Return the IRI as a string to use for label
     * 
     */
    public static function label(\EasyRdf_Graph $graph, $uri) {
        //get the locale from browser settings
        $locale = Cookie::get('locale');
        //try to get the label
        $label = $graph->label($uri, $locale);
        //if this fails try alternatives
        if (!isset($label)) {
            //get default label in English. This should be configurable on .env
            $label = $graph->label($uri, 'en');
        }
        if (!isset($label)) {
            //if no english label found try a label in any language
            $label = $graph->label($uri);
        }
        if (!isset($label)) {
            //if no label found use the resource uri as label
            $label = $uri;
        }
        return $label;
    }
    
    public static function resourceAbstract(\EasyRdf_Graph $graph, $uri) {
        $abstract_properties = [
            ['order' => 1, 'property' => "rdfs:comment"],
            ['order' => 2, 'property' => "http://dbpedia.org/ontology/abstract"],
        ];
        // sort alphabetically by name
        $order = array();
        foreach ($abstract_properties as $key => $row) {
            $order[$key] = $row['order'];
        }
        array_multisort($order, SORT_ASC, $abstract_properties);
        $abstract = null;
        $locale = Cookie::get('locale');
        foreach ($abstract_properties as $property) {
            if ($abstract == null) {
                $abstract = $graph->getLiteral($uri, new \EasyRdf_Resource($property['property']), $locale);
            } else {
                break;
            }
            if ($abstract == null) {
                //get default label in English. This should be configurable on .env
                $abstract = $graph->getLiteral($uri, new \EasyRdf_Resource($property['property']), 'en');
            }
            if ($abstract == null) {
                //if no english label found try a label in any language
                $abstract = $graph->getLiteral($uri, new \EasyRdf_Resource($property['property']));
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
        $image_properties = array(
            "foaf:depiction",
        );
        $images = [];
        foreach ($image_properties as $property) {
            $image = $graph->getResource($uri, new \EasyRdf_Resource($property));
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
