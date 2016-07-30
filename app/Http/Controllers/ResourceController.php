<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
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
        dd($type);
    }

    public function browser(Request $request) {
        $uri = $request->input('uri');
    }

    public function page(Request $request, $resource) {
        //get the url
        $uri = $request->session()->get('uri');

        if (!isset($uri)) {
            $uri = $request->getSchemeAndHttpHost() . '/resource' . '/' . $resource;
        }
        //$uri = 'http://localhost/resource/1';
        //Log::info('Log message', array('context' => 'I am on page start'));
        $graph = \EasyRdf_Graph::newAndLoad($uri, 'jsonld');
        //Log::info('Log message', array('context' => 'I am on page end'));
        //echo $graph->dump('html');
        $types = $graph->typesAsResources($uri); 
        $abstract = ResourceController::resourceAbstract($graph, $uri);
        $label = ResourceController::label($graph, $uri);
        return view('welcome',
                [
                    'graph' => $graph,
                    'label'=> $label,
                    'uri' => $uri,
                    'abstract' => $abstract,
                    'types' => $types,
                ]);
    }
    /*function to get the label of a resource based on 4 rules by priority:
     *1)Get the browser locale setting and request this language
     *2)Get the label for the default language set
     *3)Get any label in any language
     *4)Return the IRI as a string to use for label
     * 
    */
    public function label(\EasyRdf_Graph $graph, $uri) {
        //get the locale from browser settings
        $locale = Cookie::get('locale');
        //try to get the label
        $label = $graph->label($uri, $locale);
        //if this fails try alternatives
        if (!$label) {
            //get default label in English. This should be configurable on .env
            $label = $graph->label($uri, 'en');
            if (!$label) {
                //if no english label found try a label in any language
                $label = $graph->label($uri);
                if (!$label) {
                    //if no label found use the resource uri as label
                    $label = $uri;
                }
            }
        }
        return $label;
    }
    
    public function resourceAbstract(\EasyRdf_Graph $graph, $uri){
        $abstract_properties = array(
            "rdfs:comment",
            "http://dbpedia.org/ontology/abstract",
            
        );
        $locale = Cookie::get('locale');
        $abstract = $graph->get($uri, new \EasyRdf_Resource($abstract_properties[0]), $locale);
        if (!$abstract) {
            //get default label in English. This should be configurable on .env
            $abstract = $graph->get($uri, new \EasyRdf_Resource($abstract_properties[0]), 'en');
            if (!$abstract) {
                //if no english label found try a label in any language
                $abstract = $graph->get($uri, new \EasyRdf_Resource($abstract_properties[0]));
                if (!$abstract) {
                    //if no label found use the resource uri as label
                    $abstract = 'Cannot found a reliable abstract';
                }
            }
        }
        
        return $abstract;
        
    }

}
