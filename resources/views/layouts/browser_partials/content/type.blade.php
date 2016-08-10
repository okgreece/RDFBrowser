<div class="container" id="type">
    <?php
    echo trans('theme/browser/header.type');

    $arrayKeys = array_keys($types);
    // Fetch last array key
    $lastArrayKey = array_pop($arrayKeys);
    //iterate array
    $tempTypeLabel = "";
    foreach ($types as $key => $value) {
        if($value->shorten()){
            $tempTypeLabel = $value->shorten();
        }
        else{
            $tempTypeLabel = $value;
        }
        if ($key == $lastArrayKey) {
            echo ' <a href="' . $value . '">' . $tempTypeLabel . '</a>';
        } else {
            echo ' <a href="' . $value . '">' . $tempTypeLabel . '</a>' . ',';
        }
    }
    echo trans('theme/browser/header.graph');
    echo ' <a class="dont-break-out" href="$namedGraph">'. $namedGraph. '</a>';
    echo trans('theme/browser/header.dataSpace');
    echo ' <a class="dont-break-out" href="$namedGraph">'. $namedGraph. '</a>';
    ?>
    
</div> <!--/ .container -->
