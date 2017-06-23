<section id="properties">
    <div class="container">
        @include('layouts.browser_partials.content.table', ["id" => 'literals-table'])
    </div>
</section>
<script>    
$(function (){    
    $('#literals-table').DataTable({   
        fixedHeader: {header: true},
        responsive:true,
        scrollX:false,
        searching: false,
        lengthChange: false,
        columnDefs: [
            { "width": "30%", "targets":0},
            { "width": "70%", "targets":1}
            
        ],
        fixedColumns:false,
        autoWitdh:false,
        processing: true,
        serverSide: true,
        ajax: {
            "url" : '{!! route('ajax.literal') !!}',
            "type" : "GET",
            "data" : {resource:'{{$resource}}', rewrite:'{{$rewrite ? "true" : "false"}}'},
        },
        columns: [
            {data: 'property', name: 'propery', className: "property"},
            {data: 'value', name: 'value', className: "value"},
           // {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
});  
</script>
