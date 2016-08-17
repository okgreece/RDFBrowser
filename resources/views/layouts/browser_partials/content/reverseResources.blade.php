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
                        echo '<td class="property">Is <a href="' . $myResource["property"] . '">' . ((new \EasyRdf_Resource($myResource["property"]))->shorten()?: $myResource["property"]) . '</a> of</td>';
                        echo '<td class="value"><ul>';
                        foreach ($myResource["values"] as $value) {
                            echo '<li>';
                            echo '<a class="resource" href="' . $value->getUri() . '">' . ($value->shorten()?: $value->getUri()) . '</a>';
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