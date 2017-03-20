@if($lang)
<span title="{{$lang}}" class="flag-icon flag-icon-{{$lang}}"></span>
@endif
@if(is_numeric($value))
    {{rtrim(rtrim(sprintf('%.10F', $value), '0'), '.')}}
@elseif($value instanceof DateTime)
    <p class="date">{{( date_format($value, 'H:i:s') == "00:00:00" ? date_format($value, 'Y-m-d') : date_format($value, 'Y-m-d H:i:s') )}}</p>
@elseif(is_bool($value))
    @if($value)
        <p class="boolean booleanTrue">TRUE</p>
    @else 
        <p class="boolean booleanFalse">FALSE</p>
    @endif
@else 
    <p class="string" dont-break-out>{{$value}}</p>
@endif
@if($datatype)
    <a href="{{$datatype}}" class="datatype dont-break-out"> ({{(new \EasyRdf_Resource($datatype))->shorten()?: $datatype}})</a>
@endif    