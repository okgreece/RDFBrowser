<section id="resources">
    <div class="container">
        <table id="resourcesT" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>            
                    <th>{{ trans('theme/browser/datatable.property')}}</th>
                    <th>{{ trans('theme/browser/datatable.value')}}</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                foreach ($resources as $myResource) {
                    try {
                        echo '<tr>';
                        echo '<td class="property"><a class="dont-break-out" href="' . ($rewrite ? '/browser?uri='. $myResource["property"]  :$myResource["property"]) . '">' . ((new \EasyRdf_Resource($myResource["property"]))->shorten()? : \App\BrowserTrait::uknownNamespace($myResource["property"])) . '</a></td>';
                        echo '<td class="value"><ul class="term-list">';
                        foreach ($myResource["values"] as $value) {
                            echo '<li class="term-item">';
                            if($value->isBNode()){
                               $key = array_search($value->getBNodeId(), array_column($bnodes, 'bnode'));
                                echo '<a href="#popover" title="Blank Node Information" data-toggle="popover" data-trigger="focus" data-content=\''.  view('layouts.browser_partials.content.popover', ["bnode" => $bnodes[$key]]) .'\'>_:'.$value->getBNodeId().'</a>';
                            }
                            else{
                                echo '<a class="resource dont-break-out" href="' . ($rewrite ? '/browser?uri='. $value->getUri(): $value->getUri()) . '">' . ($value->shorten()? : $value->getUri()) . '</a>';
                            }                            
                            echo '</li>';
                        }
                        echo '</ul></td>';
                        echo '</tr>';
                    } catch (Exception $ex) {
                        dd($ex);
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>