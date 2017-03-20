<ul class="term-list">
    @foreach($values as $key=>$value)
    @if($key >= 3)
        <li class="term-item toggleable" hidden="">
    @else
        <li class="term-item">
    @endif
        @if($value["type"] == "bnode")
            @include('layouts.browser_partials.templates.bnode', ['value' => $value["value"], 'rewrite' => $rewrite])        
        @elseif($value["type"] == "resource")
            @include('layouts.browser_partials.templates.resource', ['value' => $value["value"], 'rewrite' => $rewrite])
        @elseif($value["type"] == "literal")
            @include('layouts.browser_partials.templates.literal', 
                [
                    'value' => $value["value"],
                    'datatype' => $value["datatype"],
                    'lang' => $value["lang"],
                    'rewrite' => $rewrite
                ]
            )
        @endif
    </li>
    @endforeach
    @if(sizeOf($values) > 3)
        <li class="more" onclick='toggleShow( event, {{sizeOf($values)}} ) '>{{trans('theme/browser/datatable.more')}}({{sizeOf($values)}})</li>
    @endif
</ul>