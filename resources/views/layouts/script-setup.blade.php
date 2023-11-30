<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GLobal functions
    function showModal(selector) {
        $('#'+selector).modal('show')
    }

    function hideModal(selector) {
        $('#'+selector).modal('hide')
    }

    $(window).on('load', function() {
    });

    $(document).ready(function(){
        // $('#init-table').DataTable({
        //     "dom": '<lf<t>ip>'
        //     });
    });

</script>
