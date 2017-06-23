<p>{{trans('theme/browser/header.type')}}
<?php
$arrayKeys = array_keys($types);
// Fetch last array key
$lastArrayKey = array_pop($arrayKeys);
//iterate array
$tempTypeLabel = "";
foreach ($types as $key => $value) {

    $tempTypeLabel = ($value->shorten() ? : $value);
    if ($key == $lastArrayKey) {
        echo ' <a class="dont-break-out" href="' . $value . '">' . $tempTypeLabel . '</a>';
    } else {
        echo ' <a class="dont-break-out" href="' . $value . '">' . $tempTypeLabel . '</a>' . ',';
    }
}
?>

{{trans('theme/browser/header.graph')}}
<a class="dont-break-out" href="{{$namedGraph}}">{{$namedGraph}}</a>
{{trans('theme/browser/header.dataSpace')}}
<a class="dont-break-out" href="{{$namedGraph}}">{{$namedGraph}}</a>
</p>
