{{$reversed ? "is " : ""}}
<a class="dont-break-out" 
   href="{{($rewrite ? 'browser?uri='. $property  : $property)}}"
   >
    {{((new \EasyRdf_Resource($property))->shorten()? : \App\BrowserTrait::uknownNamespace($property))}}
</a>
{{$reversed ? " of" : ""}}