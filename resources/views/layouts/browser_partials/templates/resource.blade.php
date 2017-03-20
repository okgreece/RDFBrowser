<a class="resource dont-break-out" 
   href="{{($rewrite ? 'browser?uri='. $value: $value)}}">
    {{(new \EasyRdf_Resource($value))->shorten()? : $value}}
</a>