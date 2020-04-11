<?php

namespace App;

use Illuminate\Http\Request;
use Asparagus\QueryBuilder;
use Cache;

class Data
{
    use BrowserTrait;
    
    function __construct($request, $resource, $internal = false) {
        $this->request = $request;
        $this->resource = $resource; 
        $this->internal = $internal;
        $this->uri = $this->setUri();
        $this->endpoint = \App\Endpoint::first()->endpoint_url;
        $this->directQuery = $this->getDirectQuery();
        $this->reverseQuery = $this->getReverseQuery();
    //    $this->bnodeQuery = $this->getBnodeQuery();
        $this->graph = $this->setGraph();
    }
    
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
    
    private function setUri(){
        if (!$this->internal) {
            $path_parts = $this->mb_pathinfo($this->resource);            
            if (isset($path_parts['extension']) && in_array($path_parts['extension'], self::$extensions)) {
                $this->extension = $path_parts['extension'];
                if ($path_parts['dirname'] != '.') {
                    $this->resource = $path_parts['dirname'] . '/' . $path_parts['filename'];
                } else {
                    $this->resource = $path_parts['filename'];
                }
            }
            return $this->constructIRI2($this->request, $this->resource);
        } else {
            return $this->resource;
        }
    }
    
    private function getDirectQuery(){
        

        $sparql = new \EasyRdf_Sparql_Client($this->endpoint);
        $query = new QueryBuilder();
        $query->select("?p", "?o")
                ->where("<" . $this->uri . ">", "?p", "?o");
        $result = $sparql->query($query);
        return $result;
    }
    
    private function getReverseQuery(){
        $sparql = new \EasyRdf_Sparql_Client($this->endpoint);
        $query = new QueryBuilder();
        $query->select("?s", "?p")
                ->where("?s", "?p", "<" . $this->uri . ">");
        $result = $sparql->query($query);
        return $result;        
    }
    
    private function getBnodeQuery(){
        $sparql = new \EasyRdf_Sparql_Client($this->endpoint);
        $query = new QueryBuilder();
        $query->select("?bnode", "?p2", "?value")
                ->where("<" . $this->uri . ">", "?p", "?o")
                ->also("?bnode", "?p2", "?value")
                ->filter("isBlank(?bnode)");
        $result = $sparql->query($query);
        return $result;
        
    }
    
    public function setGraph(){
        $graph = new \EasyRdf_Graph;
        foreach ($this->directQuery as $triple) {
            $graph->add(new \EasyRdf_Resource($this->uri), $triple->p, $triple->o);
        }        
        
        foreach ($this->reverseQuery as $triple) {
            $graph->add($triple->s, $triple->p, new \EasyRdf_Resource($this->uri));
        }
//        foreach ($this->bnodeQuery as $triple) {
//            $graph->add($triple->bnode, $triple->p2, $triple->value);
//        }

        Cache::put($this->uri, $graph, 100);
        
        return $graph;        
    }
    
    public function getMIME() {
        switch ($this->extension) {
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
    
    public function setFormat(){
        if (isset($this->extension)) {

            $MIME = $this->getMime($this->extension);
        } else {
            $MIME = $this->getContentType($this->request);
        }
        $this->MIME = $MIME;
        $this->format = \EasyRdf_Format::getFormat($MIME);
    }
    
    public function download() {
        
        $this->setFormat();
        //serialize the graph        
        $content = $this->graph->serialise($this->format);
        
        $length = strlen($content);

        $extension = \EasyRdf_Format::getFormat($this->MIME)->getDefaultExtension();

        http_response_code(200);

        header('Connection: Keep-Alive');

        header('Content-Description: File Transfer');

        header('Content-Disposition: inline; filename=' . $this->resource . '.' . $extension);

        header('Accept-Ranges: bytes');

        header('Content-Type: ' . $this->MIME);

        header('Content-Length: ' . $length);

        echo $content;

        exit;
    }

}
