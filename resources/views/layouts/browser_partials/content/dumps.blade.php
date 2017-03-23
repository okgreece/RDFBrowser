<section id="dumps" name="dumps">
    <div>
        @if(isset($uriPart))
        <h3>
            {{trans('theme/browser/dumps.data')}}:
            <br />
            <?php if(\Request::route()->getName() == "page2"){
                $modifier = "2";
            }
            else{
                $modifier  = "";
            }
            $link = isset($uriPart) ? url('/data'. $modifier .'/' . $uriPart ) : "browser?uri=" .$resource;
            ?>
            <a href="{{$link}}.csv">CSV</a> | RDF (
            <a href="{{$link}}.nt">N-Triples</a> ::
            <a href="{{$link}}.n3">N3/Turtle</a> ::
            <a href="{{$link}}.json">JSON</a> ::
            <a href="{{$link}}.rdf">XML</a> )
        </h3>
        @else
        <h3>
            {{trans('theme/browser/dumps.external')}}:
            <br />
            <a href="{{$resource}}">{{$resource}}</a>
        </h3>    
        @endif
        
    </div> 
    
</section>
