<section id="properties">
    <div class="container">
        <table id="literals" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>            
                    <th>{{ trans('theme/browser/datatable.property')}}</th>
                    <th>{{ trans('theme/browser/datatable.value')}}</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                foreach ($literals as $literal) {
                    try {
                        echo '<tr>';
                        echo '<td class="property"><a href="' . ($rewrite ? '/browser?uri='. $literal["property"] : $literal["property"])  . '">' . ((new \EasyRdf_Resource($literal["property"]))->shorten()?: \App\BrowserTrait::uknownNamespace($literal["property"])) . '</a></td>';
                        echo '<td class="value"><ul>';
                        foreach ($literal["values"] as $value) {
                            echo '<li>';
                            /*Print language flags on existence. Flags may be incorrect as language tags
                            * of RDF triples correspond to ISO 639-1, while icon-flags plugin follow 
                            * http://www.iso.org/iso/country_names_and_code_elements ISO 3166-1-alpha-2
                            * country two letter codes. Some have been fixed using the CSS. If any other 
                            * issue arise appropriate mappings should be changed on the CSS.
                            * 
                            */
                            if ($value->getLang()) {
                                echo '<span title="'. $value->getLang() .'" class="flag-icon flag-icon-' . $value->getLang() . '"></span>';
                            }
                            /*
                             * Methods for appropriate numeric representations. Formating numeric values from
                             * scientific E^n format to plain text format, reserving 10 decimal digits if available.
                             * If configured in higher number garbage are found.(tested for 20)
                             * 
                             * TODO:The significant digit should be configurable from the Admin Panel.
                             */
                            if (is_numeric($value->getValue())) {
                                echo rtrim(rtrim(sprintf('%.10F', $value->getValue()), '0'), '.');
                            } 
                            /*
                             * Method to handle dates. So far timezones are not rendered.
                             */
                            else if ($value->getValue() instanceof DateTime) {
                                $tempDate = $value->getValue();
                                $time = date_format($tempDate, 'H:i:s');
                                echo '<p class="date">' . ($time == "00:00:00" ? date_format($tempDate, 'Y-m-d') : date_format($tempDate, 'Y-m-d H:i:s') ) . '</p>';
           
                            }
                            /*
                             * Method to handle Boolean Values
                             */
                            else if(is_bool($value->getValue())){
                                if($value->getValue()){
                                    echo '<p class="boolean booleanTrue">TRUE</p>';
                                }
                                else{
                                    echo '<p class="boolean booleanFalse">FALSE</p>';
                                }
                                
                            }
                            /*
                             * Method to handle generic literals, usually rendered as strings
                             */
                            else {
                                echo '<p class="string">'. $value->getValue(). '</p>';
                            }
                            if ($value->getDataTypeUri()) {
                                echo '<a href="' . $value->getDataTypeUri() . '" class="datatype"> (' . ($value->getDataType()? : $value->getDataTypeUri()) . ')</a>';
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