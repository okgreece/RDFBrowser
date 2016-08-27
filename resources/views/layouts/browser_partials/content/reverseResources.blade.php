<script>
    $(document).ready(function () {
        $('#reverseResourcesT').DataTable();
    });
</script>
<section id="reverseResources">
    <div class="container">
        <table id="reverseResourcesT" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>            
                    <th>{{ trans('theme/browser/datatable.property')}}</th>
                    <th>{{ trans('theme/browser/datatable.value')}}</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                foreach ($reverseResources as $myResource) {
                    try {
                        echo '<tr>';
                        echo '<td class="property">Is <a href="' . ($rewrite ? '/browser?uri='. $myResource["property"]  :$myResource["property"]) . '">' . ((new \EasyRdf_Resource($myResource["property"]))->shorten()?: \App\BrowserTrait::uknownNamespace($myResource["property"])) . '</a> of</td>';
                        echo '<td class="value"><ul class="term-list">';
                        foreach ($myResource["values"] as $value) {
                            echo '<li class="term-item">';
                            echo '<a class="resource" href="' . ($rewrite ? '/browser?uri='. $value->getUri(): $value->getUri()) . '">' . ($value->shorten()?: $value->getUri()) . '</a>';
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