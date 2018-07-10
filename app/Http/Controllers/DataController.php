<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class DataController extends Controller {

    use \App\BrowserTrait;

    private static $extensions = [
        "rdf",
        "nt",
        "csv",
        "ttl",
        "n3",
        "json",
        "xml",
        "html"
    ];

    public function data(Request $request, $resource, $internal = false) {

        $this->setNamespaces();

        $endpoint = \App\Endpoint::first();
        $sparql = new \EasyRdf_Sparql_Client($endpoint->endpoint_url);
        if (!$internal) {
            $path_parts = $this->mb_pathinfo($resource);            
            if (isset($path_parts['extension']) && in_array($path_parts['extension'], self::$extensions)) {
                $extension = $path_parts['extension'];
                if ($path_parts['dirname'] != '.') {
                    $resource = $path_parts['dirname'] . '/' . $path_parts['filename'];
                } else {
                    $resource = $path_parts['filename'];
                }
            }
            $uri = $this->constructIRI2($request, $resource);
        } else {
            $uri = $resource;
        }


        //create queries

        $direct_query = 'SELECT ?p ?o WHERE {<' . $uri . '> ?p ?o . }';
        $direct_result = $sparql->query($direct_query);

        $reverse_query = 'select ?s ?p where {?s ?p <' . $uri . '> } ';
        $reverse_result = $sparql->query($reverse_query);
        $bnode_query = 'select ?bnode ?p2 ?value where {<' . $uri . '> ?p ?bnode . ?bnode ?p2 ?value .  filter isBlank(?bnode)} ';
        $bnode_result = $sparql->query($bnode_query);

        $graph = new \EasyRdf_Graph;
        foreach ($direct_result as $triple) {
            $graph->add(new \EasyRdf_Resource($uri), $triple->p, $triple->o);
        }
        foreach ($reverse_result as $triple) {
            $graph->add($triple->s, $triple->p, new \EasyRdf_Resource($uri));
        }
        foreach ($bnode_result as $triple) {
            $graph->add($triple->bnode, $triple->p2, $triple->value);
        }
        
        if ($internal) {
            Cache::put($uri, $graph, 100);
            return $graph;
        }
        //get the format
        if (isset($extension)) {

            $MIME = DataController::getMime($extension);
        } else {
            $MIME = DataController::getContentType($request);
        }

        $format = \EasyRdf_Format::getFormat($MIME);
        //set status
        $status = $graph->isEmpty() ? 404 : 200;
        //serialize the graph
        $content = $graph->serialise($format);
        //create and send the file
        DataController::createFile($content, $MIME, $resource, $status);
        exit;
    }

//    public function multibyte_pathinfo($path) {
//        $pathinfo = [];
//        $dirEnd = strrpos($path, '/');
//        $dotPosition = strrpos($path, '\.');
//        $pathinfo['basename'] = $dirEnd ? mb_substr($path, $dirEnd) : $path;
//        $pathinfo['dirname'] = $dirEnd ? mb_substr($path, 0, $dirEnd + 1) : "";
//        $pathinfo['extension'] = $dotPosition ? mb_substr($path, $dotPosition) : "";
//        dd($pathinfo['extension']);
//        $pathinfo['filename'] = $dotPosition ? mb_substr($path, $dirEnd ?: 0, $dotPosition - $dirEnd + 1) : $pathinfo['basename'];
//        return $pathinfo;
//    }
//    
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

    public function getMIME($extension) {
        switch ($extension) {
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
                $MIME = 'application/ld+json';
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

    public function createFile($content, $MIME, $resource, $status) {

        $length = strlen($content);

        $extension = \EasyRdf_Format::getFormat($MIME)->getDefaultExtension();

        http_response_code($status);

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
