<script>
    $(document).ready(function() {
        const previewTemplate = `<div class="dz-preview dz-file-preview">
        <div class="dz-details">
          <div class="dz-thumbnail">
            <img data-dz-thumbnail>
            <span class="dz-nopreview">No preview</span>
            <div class="dz-success-mark"></div>
            <div class="dz-error-mark"></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <div class="progress">
              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
            </div>
          </div>
          <div class="dz-filename" data-dz-name></div>
          <div class="dz-size" data-dz-size></div>
        </div>
        </div>`;

        $('.btn-save-object').on('click', function(e){
            e.preventDefault();
            e.stopPropagation();

            var myDropzone = Dropzone.forElement("#object-dropzone");
            myDropzone.removeAllFiles(true);

            $('#modalCenter').modal('hide');
            $('#init-table').DataTable().ajax.reload();
        });


        let bucket = `{{ Request::segment(2) }}`;

        Dropzone.options.objectDropzone = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, // MB
            autoProcessQueue: true,
            uploadMultiple: true,
            addRemoveLinks: true,
            parallelUploads: 10,
            previewTemplate: previewTemplate,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        };

       $(document).on('click', '.btn-privacy', function(event){
            event.preventDefault();

            showModal('modalPrivacy');
        });

        $(document).on('click', '.btn-share', function(event){
            event.preventDefault();
            showModal('modalShare');

            var url = $(this).attr('href');

            $('.form-share').trigger("reset");
            $('.form-share').attr('action', $(this).attr('href'));
            $('.form-share').attr('method','GET');

            $(document).on('hide.bs.modal','#modalShare', function(event){
                location.reload();
            });

            $(document).on('click', '.btn-copy-url', function(e) {
                e.preventDefault()
                var textToCopy = $(this).attr('data-ssh');

                if (textToCopy != null || textToCopy != " " || textToCopy != ""){
                    toastr.success("URL Copied");
                } else {
                    toastr.error("Failed Copying URL");
                }

                var tempTextarea = $('<textarea>');
                $('#modalShare').append(tempTextarea);
                tempTextarea.val(textToCopy).select();
                document.execCommand('copy');
                tempTextarea.remove();
            });

        $(document).on('click', '.btn-copy-presigned', function(e) {
                e.preventDefault()
                var textToCopy = $(this).attr('data-ssh');

                console.log(textToCopy);

                var tempTextarea = $('<textarea>');
                    $('#modalShare').append(tempTextarea);
                tempTextarea.val(textToCopy).select();
                document.execCommand('copy');
                tempTextarea.remove();

                if (textToCopy != null || textToCopy != " " || textToCopy != ""){
                    toastr.success("URL Copied");
                } else {
                    toastr.error("Failed Copying URL");
                }
            });

        });

        $('#form-share').submit(function(event){
               event.preventDefault();
               var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                })
               .done(function(res, xhr, meta) {
                    $('.generated-link').html(`
                        <hr>
                        <div>
                        <label for="presigned_url"> Url</label>
                        <textarea class="form-control mb-2" name="presigned_url" id="presigned_url" cols="50" rows="10">${res.data.presigned_url}</textarea>
                        <a href="#" data-ssh="${res.data.presigned_url}" class="btn btn-sm btn-label-primary btn-icon p-1 btn-copy-presigned" title="Copy URL">
                            <span class="svg-icon svg-icon-md power-btn-action">
                                <i class="menu-icon tf-icons ti ti-xs ti-copy text-primary m-2" ></i>
                            </span>
                        </a>
                        </div>
                    `)
               })
               .fail(function(res, error) {
                   toastr.error(res.responseJSON.message)
               })
               .always(function() { });
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
                   }
               });
           });

       $('#form-submit').submit(function(event){
               event.preventDefault();
               var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
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
