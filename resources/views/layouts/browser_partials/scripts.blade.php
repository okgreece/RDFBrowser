<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/browser_assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('/browser_assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/browser_assets/js/app.min.js') }}" type="text/javascript"></script>


<script src="{{ asset('/browser_assets/js/jquery.easing.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/browser_assets/js/scrolling-nav.js') }}" type="text/javascript"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>

<!--    Leaflet-->
 <script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>

<script>
function filterGlobal() {
    $('.dataTable').DataTable().search(
            $('#global_filter').val(),
            $('#global_regex').prop('checked'),
            $('#global_smart').prop('checked')
            ).draw();
}
$(document).ready(function () {
    var table = $('table.display').DataTable({
        fixedHeader: {header: true},
        pageLength: 50,
        lengthChange: false,
    });

    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
});
</script>