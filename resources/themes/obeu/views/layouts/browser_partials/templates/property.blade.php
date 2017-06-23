{{$reversed ? "is " : ""}}
<strong>
    <a class="dont-break-out resource-link" 
       href="{{($rewrite ? 'browser?uri='. $property  : $property)}}"
       >
        {{((new \EasyRdf_Resource($property))->shorten()? : \App\BrowserTrait::uknownNamespace($property))}}
    </a>
</strong>    
{{$reversed ? " of" : ""}}