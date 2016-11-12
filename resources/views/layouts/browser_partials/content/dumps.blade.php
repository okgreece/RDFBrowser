<section id="dumps" name="dumps">
    <div>
        <h3>
            <?php echo trans('theme/browser/dumps.data');?>:
            <br />
            <?php if(\Request::route()->getName() == "page2"){
                $modifier = "2";
            }
            else{
                $modifier  = "";
            }
            ?>
            <a href="<?php echo url('/data'. $modifier .'/' . $resource . '.csv'); ?>">CSV</a> 
            | RDF (
            <a href="<?php echo url('/data'. $modifier .'/' . $resource . '.nt'); ?>">N-Triples</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $resource . '.n3'); ?>">N3/Turtle</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $resource . '.json'); ?>">JSON</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $resource . '.rdf'); ?>">XML</a> )
        </h3>
    </div> 
    
</section>
