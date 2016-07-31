<section id="dumps" name="dumps">
    <div>
        <h3>
            <?php echo trans('theme/browser/dumps.data');?>:
            <br />
            <a href="<?php echo url('/data/' . $resource . '.csv'); ?>">CSV</a> 
            | RDF (
            <a href="<?php echo url('/data/' . $resource . '.nt'); ?>">N-Triples</a> ::
            <a href="<?php echo url('/data/' . $resource . '.n3'); ?>">N3/Turtle</a> ::
            <a href="<?php echo url('/data/' . $resource . '.json'); ?>">JSON</a> ::
            <a href="<?php echo url('/data/' . $resource . '.rdf'); ?>">XML</a> )
        </h3>
    </div> 
</section>
