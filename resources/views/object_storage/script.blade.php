<script>
     $(document).ready(function() {
        $(document).on('click', '.btn-delete', function(event){
                event.preventDefault();
                var url = $(this).attr('href');

                Swal.fire({
                    title: 'Delete?',
                    text: "Are you sure removing this data? this action can't be undone, To continue please enter the bucket name.",
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn',
                        cancelButton: 'btn btn-label-secondary',
                        confirmButtonColor: '#0073C0',
                    },
                    input: 'text',
                    inputAttributes: {
                      autocapitalize: 'off'
                    },
                    focusConfirm: false,
                    preConfirm: bucket => {
                        return $.ajax({
                                url: `/object-storage/${bucket}/confirm-delete`,
                                type: 'GET',
                                dataType: 'json',
                            })
                            .done(function(res, xhr, meta) {
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                })
                                .done(function(res, xhr, meta) {
                                    toastr.success(res.message, 'Success')

                                    $('#init-table').DataTable().ajax.reload();
                                })
                                .fail(function(res, error) {
                                    toastr.error(res.responseJSON.message, 'Gagal')
                                })
                                .always(function() { });
                            })
                            .fail(function(res, error) {
                                Swal.enableButtons()
                                Swal.showValidationMessage('Request failed: Invalid bucket name!');
                            })
                            .always(function() { });
                    },
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    buttonsStyling: true
                })
            });

        $('#form-submit').submit(function(event){
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                })
                .done(function(res, xhr, meta) {
                    toastr.success(res.message)

                    $('#init-table').DataTable().ajax.reload();

                    hideModal('modalCenter');
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message)
                })
                .always(function() { });
            });
    });
</script>
