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
            <a href="<?php echo url('/data'. $modifier .'/' . $uriPart . '.csv'); ?>">CSV</a> 
            | RDF (
            <a href="<?php echo url('/data'. $modifier .'/' . $uriPart . '.nt'); ?>">N-Triples</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $uriPart . '.n3'); ?>">N3/Turtle</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $uriPart . '.json'); ?>">JSON</a> ::
            <a href="<?php echo url('/data'. $modifier .'/' . $uriPart . '.rdf'); ?>">XML</a> )
        </h3>
    </div> 
    
</section>
