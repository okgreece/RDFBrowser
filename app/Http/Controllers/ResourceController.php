<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

use App\Http\Requests;

use EasyRDF;

class ResourceController extends Controller
{
    //
    public function negotiation(Request $request, $section)
    {

        $resource = $request->fullUrl();
        $type = $request->prefers('text/html', 'application/rdf+xml');
        if($type == 'text/html'){
          return redirect()->route('page', ['section' => $section],'303' )->with('url', $resource);
        }
        else {
          return redirect()->route('data',['section' => $section],'303' )->with('url', $resource);
        }

    }

    public function noResource()
    {
        $type = "You have not provided a valid resource. Please try again";
        dd($type);
    }

    public function browser(Request $request)
    {
        $url = $request->input( 'url');

    }

    public function page(Request $request, $resource)
    {
      $url =  $request->session()->get('url');
      $graph = \EasyRDF_Graph::newAndLoad($url);
      $graph->dump();

    }

    public function data($resource)
    {
        dd($resource);
    }
}
