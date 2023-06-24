</div>
</div>
</div>
<div class="footer clearfix">
    <div class="footer-inner">
        {{ date("Y") }} &copy; QueueLines.
    </div>
    <div class="footer-items">
        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>

<script src="{{ url('/assets/dashboard') }}/assets/js/jquery.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/js/jquery-ui.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js">
</script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/blockUI/jquery.blockUI.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/iCheck/jquery.icheck.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/perfect-scrollbar/src/perfect-scrollbar-rtl.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/less/less-1.5.0.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js">
</script>
<script src="{{ url('/assets/dashboard') }}/assets/js/main.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/flot/jquery.flot.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
>
<script src="{{ url('/assets/dashboard') }}/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>


<script src="{{ url('/assets/dashboard') }}/assets/plugins/summernote/build/summernote.min.js"></script>

<script src="{{ url('/assets/dashboard') }}/assets/plugins/ckeditor/ckeditor.js"></script>

<script src="{{ url('/assets/dashboard') }}/assets/plugins/ckeditor/adapters/jquery.js"></script>

<script src="{{ url('/assets/dashboard') }}/assets/js/form-elements.js"></script>

<script src="{{ url('/assets/dashboard') }}/assets/js/mapboxGL.js"></script>
<script src="{{ url('/assets/dashboard') }}/assets/js/mapboxGEOCODER.js"></script>
<script src="{{ url("/js/config.js") }}"></script>
<script type="text/javascript" src="{{ url('/assets/dashboard') }}/assets/js/toastify-js"></script>

<script>
    initBaseUrl("{{ url('') }}")

</script>


<script>
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();




    });

    $(".nav-tabs li a").click(function () {
        var url = "{{ url('/') }}";
        var hash = $(this).attr("href");

        hash = hash.substring(1, hash.length); //remove #
        $.ajax({
            url: url + "/dashboard/change_hash_tab/" + hash
        });
    });

    mapboxgl.accessToken =
        'pk.eyJ1Ijoid2FzZWVtYWxoYWJhc2giLCJhIjoiY2pzcWo3MmgyMTRlNTQ0bzQ1MWMyOGtzZSJ9.Hk7_kl2Oh9TH-i8513BV1g';
    mapboxgl.setRTLTextPlugin('{{ url("/assets/dashboard") }}/assets/js/mapboxRTL.js');

</script>


</body>

</html>
