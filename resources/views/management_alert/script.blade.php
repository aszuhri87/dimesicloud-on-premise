<script>
    $(document).ready(function() {
        $('#sendEmail').on('change', function(e){
            e.preventDefault();
            $(this).prop('checked', true)

            $('#sendTele').remove('checked');

            $('.tele-form').remove();

            $('.form-place').html(`
                <div class="email-form">
                    <label class="form-label" for="basic-default-email">Email Address</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="email-form"
                        name="value"
                        class="form-control"
                        placeholder="Enter email address..."
                        aria-label="Enter email address..."
                        aria-describedby="basic-default-email2" required />
                    </div>
                </div>
            `);
        });

        $('#sendTele').on('change', function(e){
            e.preventDefault();
            $(this).attr('checked')
            $('#sendEmail').attr('checked', false);

            $('.email-form').remove();

            $('.form-place').html(`
                <div class="tele-form">
                    <label class="form-label" for="basic-default-email">Group ID</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="tele-form"
                        name="value"
                        class="form-control"
                        placeholder="Enter group id..."
                        aria-label="Enter group id..."
                        aria-describedby="basic-default" required />
                    </div>
                </div>
            `);
        });

        $(document).on('click', '.btn-delete', function(event){
                event.preventDefault();
                var url = $(this).attr('href');

                Swal.fire({
                    title: 'Delete?',
                    text: "Are you sure removing this data? this action can't be undone!",
                    icon: 'question',
                    customClass: {
                        confirmButton: 'btn',
                        cancelButton: 'btn btn-label-secondary',
                        confirmButtonColor: '#0073C0',
                    },
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    buttonsStyling: true
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            dataType: 'json',
                        })
                        .done(function(res, xhr, meta) {
                            toastr.success(res.message, 'Success')

                            $('#email-table').DataTable().ajax.reload();
                            $('#tele-table').DataTable().ajax.reload();$('#init-table').DataTable().ajax.reload();
                        })
                        .fail(function(res, error) {
                            toastr.error(res.responseJSON.message, 'Gagal')
                        })
                        .always(function() { });
                    }
                });
            });

        $('#form-submit').submit(function(event){
                event.preventDefault();

                $.ajax({
                    url: '/management-alert',
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                })
                .done(function(res, xhr, meta) {
                    toastr.success(res.message)

                    $('#email-table').DataTable().ajax.reload();
                    $('#tele-table').DataTable().ajax.reload();

                    hideModal('modalCenter');
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message)
                })
                .always(function() { });
            });
    });


</script>
