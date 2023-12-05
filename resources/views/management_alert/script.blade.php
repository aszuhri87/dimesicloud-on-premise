<script>
    $(document).ready(function() {
        $('#sendEmail').on('change', function(e){
            e.preventDefault();
            $(this).prop('checked', true)

            $('#sendTele').remove('checked');

            $('.form-place').html(`
                <div class="email-form">
                    <label class="form-label" for="basic-default-email">Email</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="email-form"
                        name="email"
                        class="form-control"
                        placeholder="example@mail.com"
                        aria-label="example@mail.com"
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
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message)
                })
                .always(function() { });
            });
    });
</script>
