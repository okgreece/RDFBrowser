<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class ResourceController extends Controller {

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

    public function browser(Request $request) {
        $uri = $request->input('uri');

        return $uri;
    }

    public function page(Request $request, $resource) {
        //get the url
        $uri = $request->session()->get('uri');
        if (!isset($uri)) {
            $uri = $request->getSchemeAndHttpHost() . '/resource' . '/' . urldecode($resource);
        }
        $graph = \EasyRdf_Graph::newAndLoad($uri, 'jsonld');
        $label = ResourceController::label($graph, $uri);
        if (!empty($graph->resources())) {
            $types = $graph->typesAsResources($uri);
            $namedGraph = ResourceController::getNamedGraph($uri);
            $abstract = ResourceController::resourceAbstract($graph, $uri);
            $literals = ResourceController::getAllLiterals($graph, $uri);
            $resources = ResourceController::getAllResources($graph, $uri);
            $reverseResources = ResourceController::getAllReverseResources($graph, $uri);
            $images = ResourceController::getAllImages($graph, $uri);
            $map = ResourceController::getGEO($graph, $uri);
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
            ]);
        } else {
            return view('errors.noResource', [
                'label'=> $label,
            ]);
        }
    }

    /* function to get the label of a resource based on 4 rules by priority:
     * 1)Get the browser locale setting and request this language
     * 2)Get the label for the default language set
     * 3)Get any label in any language
     * 4)Return the IRI as a string to use for label
     * 
     */

    public function label(\EasyRdf_Graph $graph, $uri) {
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

    //maybe should change this method later on. double foreach 
    //1st on language, 2nd on property
    public function resourceAbstract(\EasyRdf_Graph $graph, $uri) {
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


        $sparql = new \EasyRdf_Sparql_Client('http://155.207.126.5:8890/sparql');

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
        $images = array();
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
                $data = ResourceController::dualExtractor($graph, $uri, $extractor);
            } else {
                $data = ResourceController::singleExtractor($graph, $uri, $extractor);
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
