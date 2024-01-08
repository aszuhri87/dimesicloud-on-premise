<script type="text/javascript">
    var vmTable = function() {
        var init_table;

        var keyname = [];
        var select_all = false;
        var length = 0;

        $(document).ready(function() {
            initTable();
        });

        var bucket = '{{ Request::segment(2) }}';

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: `{{ url('object-storage/${ bucket }/dt') }}`,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        defaultContent: '',
                        width: '5%'
                    },
                    {
                        data: 'name',
                        width: '55%'
                    },
                    {
                        data: 'size',
                        width: '10%'
                    },
                    {
                        data: 'last_modified',
                        width: '15%'
                    },
                    {
                        defaultContent: '',
                        width: '10%'
                    },
                ],
                columnDefs: [
                    {
                      // For Checkboxes
                      targets: 0,
                      searchable: false,
                      orderable: false,
                      render: function (data, type, full, meta) {
                        return `<input type="checkbox" class="dt-checkboxes form-check-input" value="${full['name']}">`;
                      },
                      checkboxes: {
                        selectRow: true,
                        selectAllRender:  function (data, type, full, meta){
                            return `<input type="checkbox" class="select-all form-check-input" value="[${data}]">`;
                        }

                      }
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            return `
					        	<a href="{{ url('object-storage/${bucket}/${data}/show-object') }}" class="d-flex mt-3">
                                    <span class="tf-icons ti ti-folders text-primary"></span> <p class="text-dark mx-1"> ${ full['name']} </p>
					        	</a>
					        `
                        }
                    },
                    {
                        targets: 2,
                        data: 'size',
                        render: function(data, type, full, meta) {
                            return bytesToSize(data);
                        }
                    },
                    {
                        targets: -1,
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        data: "name",
                        render: function(data, type, full, meta) {
                            return `
                                <div class="">
                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                        style="width:38px; height:38px;" data-bs-toggle="dropdown">
                                        <span class="tf-icons ti-xs ti ti-dots-vertical text-center"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{--
                                        <li>
                                            <a href=""
                                                class="dropdown-item d-flex align-items-center btn-privacy btn-running">
                                                <p class="no-ws">
                                                    <span class="tf-icons ti-xs ti ti-player-play"></span> Change Privacy
                                                </p>
                                            </a>
                                        </li>
                                        --}}
                                        <li>
                                            <a href="{{ url('object-storage/${bucket}/${data}/share-object') }}"
                                                class="dropdown-item d-flex align-items-center btn-share btn-stopped">
                                                <p class="no-ws">
                                                    <span class="tf-icons ti-xs ti ti-share mb-1"></span> Share
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('object-storage/${bucket}/${data}/delete-object') }}"
                                                class="dropdown-item d-flex align-items-center btn-delete btn-stopped">
                                                <p class="no-ws">
                                                    <span class="tf-icons ti ti-xs ti-trash-x text-danger mb-1"></span> Delete
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            `
                        }
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                dom: '<"row"<"col-sm-6 col-md-3 col-lg-3"l><"col-xs-3 col-md-6 col-lg-6 button-gr text-center text-md-end text-lg-end"B><"col-xs-3 col-md-3 col-lg-3 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                  text: '+ Create Object',
                  className: 'btn btn-primary mt-3 btn-create-object',
                  action: function(e, dt, node, config) {
                    showModal('modalCenter')
                  }
                }],
                select: {
                    // Select style
                    style: 'multi'
                }
            });


            init_table.on('click', '.select-all', function (e) {
                var keyname = [];
                if($(this).is(":checked") == true){
                    var ex = init_table.rows().iterator('row', function(context, index){
                        key = $(this.row(index).data());
                        keyname.push(key.toArray()[0].name)
                    });

                    init_table.button().add(0, {
                        text: '<span class="tf-icons ti ti-sm ti-trash-x text-white mb-1"></span>',
                        className: 'btn btn-sm btn-danger mt-3 btn-delete-all',
                        action: function (e, dt, button, config ) {
                            e.preventDefault();

                            var url = `/object-storage/${bucket}/${keyname}/delete-all-object`;

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
                        },
                    } );
                } else {
                    init_table.buttons('.btn-delete-all').remove()
                }
            });

            init_table.on('click', '.dt-checkboxes', function (e) {
                e.preventDefault()
                var key = $(this).val()

                if($(this).is(':checked') == true){
                    keyname.push(key);
                } else {
                    keyname = keyname.filter(function( obj ) {
                      return obj !== key;
                    });
                }

                if(keyname.length > 0){
                    $('.select-all').prop("checked", true)
                } else {
                    $('.select-all').prop("checked", false)
                }

                if(!$(".btn-delete-all")[0] && $('.select-all').is(":checked") == true){
                        init_table.button().add(0, {
                            text: '<span class="tf-icons ti ti-sm ti-trash-x text-white mb-1"></span>',
                            className: 'btn btn-sm btn-danger mt-3 btn-delete-all',
                            action: function (e, dt, button, config) {
                                e.preventDefault();

                                var url = `/object-storage/${bucket}/${keyname}/delete-all-object`;

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
                                            keyname = []
                                        })
                                        .fail(function(res, error) {
                                            toastr.error(res.responseJSON.message, 'Gagal')
                                        })
                                        .always(function() { });
                                    }
                                });
                            },
                        });

                } else {
                    if($('.select-all').is(":checked") == false ){
                        init_table.buttons('.btn-delete-all').remove()
                    }
                }

            });

        }
    }();
</script>
