<strong>
    <a class="resource dont-break-out resource-link" 
       href="{{($rewrite ? 'browser?uri='. $value: $value)}}">
        {{(new \EasyRdf_Resource($value))->shorten()? : $value}}
    </a>
</strong>
