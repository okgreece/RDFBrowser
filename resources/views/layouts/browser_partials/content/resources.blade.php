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
                        echo '<td class="property"><a href="' . $myResource["property"] . '">' . ((new \EasyRdf_Resource($myResource["property"]))->shorten()? : $myResource["property"]) . '</a></td>';
                        echo '<td class="value"><ul>';
                        foreach ($myResource["values"] as $value) {
                            echo '<li>';
                            echo '<a class="resource" href="' . $value->getUri() . '">' . ($value->shorten()? : $value->getUri()) . '</a>';
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