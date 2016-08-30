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
                            echo '<a class="resource dont-break-out" href="' . ($rewrite ? '/browser?uri='. $value->getUri(): $value->getUri()) . '">' . ($value->shorten()? : $value->getUri()) . '</a>';
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