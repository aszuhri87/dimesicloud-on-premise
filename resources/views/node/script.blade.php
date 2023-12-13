<script>
    $(document).ready(function() {
        initAction();
    });

    const initAction = () => {
        $(document).on('click', '.btn-start', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will start virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Start!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {

                    })
                    .always(function() {

                    });

                }
            });
        });

        $(document).on('click', '.btn-reboot', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will restart virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Restart!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {

                    })
                    .always(function() {

                    });

                }
            });
        });

        $(document).on('click', '.btn-shutdown', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will shutdown virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Shutdown!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {

                    })
                    .always(function() {

                    });

                }
            });
        });
    };
</script>
