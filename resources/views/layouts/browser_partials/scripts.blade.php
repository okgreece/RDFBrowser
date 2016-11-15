<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/browser_assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('/browser_assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/browser_assets/js/app.min.js') }}" type="text/javascript"></script>


<script src="{{ asset('/browser_assets/js/jquery.easing.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/browser_assets/js/scrolling-nav.js') }}" type="text/javascript"></script>

<script src="{{ asset('/browser_assets/js/entity-labels.js') }}" type="text/javascript"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
<!--    Leaflet-->
<script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
<!--    Lightbox-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script> 

<!--Lazy Load Images-->
<!--<script src="{{ asset('/browser_assets/js/jquery.imglazy.js') }}" type="text/javascript"></script>-->
<script>
function filterGlobal() {
    $('.dataTable').DataTable().search(
            $('#global_filter').val(),
            $('#global_regex').prop('checked'),
            $('#global_smart').prop('checked')
            ).draw();
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    var pagingType = '';
    console.log(pagingType);
    if(screen.width>500){
        pagingType = 'simple_numbers';
        console.log(pagingType);
    }
    else{
         pagingType = 'simple';
         console.log(pagingType);
    }
    var table = $('table.display').DataTable({
        fixedHeader: {header: true},
        responsive:true,
        pageLength: 20,
        pagingType: pagingType,
        scrollX:false,
        order: [],
        deferRender:true,
        lengthChange: false,
        language: {
            url: "../browser_assets/plugins/datatables/i18n/{{Cookie::get('locale')}}.json"
        },
        columnDefs: [
            { "width": "30%", "targets":0},
            { "width": "70%", "targets":1}
            
        ],
       
        fixedColumns:false,
        autoWitdh:false
    });
    $('[data-toggle="popover"]').popover({html:true});

    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('ul.term-list').each(function () {
        var listLength = $(this).find('li').length;
        if ( listLength > 3) {
            $('li', this).eq(2).nextAll().hide().addClass('toggleable');
            $(this).append('<li class="more">{{trans('theme/browser/datatable.more')}}('+listLength+')</li>');
        }
        $(this).on('click', '.more', listLength, toggleShow);
    });
    
//    labels(".resource");
//    console.log("labels loaded");
//    

});
    
    


    function toggleShow(listLength) {
        var opened = $(this).hasClass('less');
        var more = '{!!trans('theme/browser/datatable.more')!!}(' + listLength.data+')';
        var less = '{!!trans('theme/browser/datatable.less')!!}';
        $(this).text(opened ? more : less).toggleClass('less', !opened);
        $(this).siblings('li.toggleable').slideToggle();
    }
</script>
