<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller {
    
    use \App\BrowserTrait;

    public function data(Request $request, $resource) {
        
        $this->setNamespaces();
        
        $endpoint = \App\Endpoint::all();
        $sparql = new \EasyRdf_Sparql_Client($endpoint[0]->endpoint_url);

        $path_parts = pathinfo($resource);
        if (isset($path_parts['extension'])) {
            $extension = $path_parts['extension'];
            logger($path_parts);
            if(!empty($path_parts['dirname'])){
                $resource = $path_parts['dirname'] . '/' .$path_parts['filename'];
            }
            else{
                $resource = $path_parts['filename'];
            }                    
        }
        $uri = $this->constructIRI2($request, $resource);
        
        $query = 'DESCRIBE <' . $uri . '>';
        $result = $sparql->query($query);
   
        //dd($result);
        if (isset($extension)) {
            
            $MIME = DataController::getMime($extension);
        } else {
            $MIME = DataController::getContentType($request);
        }

        $format = \EasyRdf_Format::getFormat($MIME);
        //echo $result;
       
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
