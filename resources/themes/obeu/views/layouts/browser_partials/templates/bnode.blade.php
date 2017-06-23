<a href="#popover" onclick='myPopover(event)' title="Blank Node Information" data-toggle="popover" data-trigger="focus" 
   data-content='
   {{(\App\BrowserTrait::getBNodeDescription(\Cache::get(session("resource")) , $value))}}
   '>
    _:{{$value}}
</a>