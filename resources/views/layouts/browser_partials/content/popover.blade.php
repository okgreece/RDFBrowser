@foreach($bnode["properties"] as $property)
<div class="popover-content">
    <div class="popover-property">
        <?php $resource_property = new \EasyRdf_Resource($property["property"]);?>
        {{$resource_property->shorten() ? : \App\BrowserTrait::uknownNamespace($resource_property)}}
    </div>
    <div class="popover-value">
        <ul>
    @foreach($property["value"] as $value)
    <li>
        <?php 
            if(is_a($value, 'EasyRdf_Resource')){
                $newValue = $value->shorten()?: \App\BrowserTrait::uknownNamespace($value->getUri());
                echo '<a href="' .$value. '">' . $newValue . '</a>';
            }
            else{
                if(is_bool($value->getValue())){
                    if($value->getValue()){
                        echo '<p class="boolean booleanTrue">TRUE</p>';
                    }
                    else{
                        echo '<p class="boolean booleanFalse">FALSE</p>';
                    }
                }
                else{
                    echo $value;
                }
                if ($value->getDataTypeUri()) {
                    echo '<a href="' . $value->getDataTypeUri() . '" class="datatype dont-break-out"> (' . ($value->getDataType()? : $value->getDataTypeUri()) . ')</a>';
                }
            }
        ?>
        
    </li>
    @endforeach
    </ul></div>
</div>
@endforeach