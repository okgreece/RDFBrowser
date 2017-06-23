<!-- REQUIRED JS SCRIPTS -->

<script src="{{ asset('/browser_assets/js/jquery.easing.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/browser_assets/js/entity-labels.js') }}" type="text/javascript"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('/browser_assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--    Leaflet-->
<script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>

<!--    Lightbox-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script> 

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

    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });

});
    function toggleShow(event, length) {
        var opened = $(event.target).hasClass('less');
        console.log(event.target.parentElement);
        var more = '{!!trans('theme/browser/datatable.more')!!}(' +length+')';
        var less = '{!!trans('theme/browser/datatable.less')!!}';
        $(event.target).text(opened ? more : less).toggleClass('less', !opened);
        $(event.target).siblings('li.toggleable').slideToggle();
    }
    
    function myPopover(event){
        $(event.target).popover({html:true});
        $(event.target).popover('show');
    }
</script>
