<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class DataController extends Controller {

    public function data(Request $request, $resource) {


        $sparql = new \EasyRdf_Sparql_Client('http://155.207.126.5:8890/sparql');

        $path_parts = pathinfo($resource);
        if (isset($path_parts['extension'])) {
            $extension = $path_parts['extension'];
            $resource = $path_parts['filename'];
        }

        $uri = $request->getSchemeAndHttpHost() . '/resource' . '/' . $resource;

        $result = $sparql->query('Describe <' . $uri . '>');

        if (isset($extension)) {
            
            $MIME = DataController::getMime($extension);
        } else {
            $MIME = DataController::getContentType($request);
        }

        $format = \EasyRdf_Format::getFormat($MIME);

        $content = $result->serialise($format);

        DataController::createFile($content, $MIME, $resource);

        exit;
    }
    
    public function getMIME($extension){
        switch ($extension){
            case 'rdf':
                $MIME = 'application/rdf+xml';
                break;
            case 'n3' :
                $MIME = 'text/n3';
                break;
            case 'nt' :
                $MIME = 'application/n-triples';
                break;
            case 'jsonld':
                $MIME  = 'application/ld+json';
                break;
            case 'ttl':
                $MIME = 'text/turtle';
                break;
            case 'csv':
                $MIME = 'text/csv';
                break;
            case 'json':
                $MIME = 'application/rdf+json';
                break;
            default:
                $MIME = 'application/rdf+xml';
                
        }        
        return $MIME;
    }

    public function getContentType(Request $request) {
        //instantiate negotiator
        $negotiator = new \Negotiation\Negotiator();

        //get the header
        $header = $request->header('Accept');

        //set the available content types
        $priorities = array('application/rdf+xml', 'text/n3', 'application/ld+json', 'text/turtle', 'application/rdf+json', 'application/n-triples');

        //get the best match
        $mediaType = $negotiator->getBest($header, $priorities);
        //dd($mediaType);
        //get the value
        if ($mediaType != null) {
            $type = $mediaType->getValue();
        } else {
            $type = 'application/rdf+xml';
        }

        return $type;
    }

    public function createFile($content, $MIME, $resource) {

        $length = strlen($content);

        $extension = \EasyRdf_Format::getFormat($MIME)->getDefaultExtension();

        header('Connection: Keep-Alive');

        header('Content-Description: File Transfer');

        header('Content-Disposition: inline; filename=' . $resource . '.' . $extension);

        header('Accept-Ranges: bytes');

        header('Content-Type: ' . $MIME);

        header('Content-Length: ' . $length);

        echo $content;

        exit;
    }

}
