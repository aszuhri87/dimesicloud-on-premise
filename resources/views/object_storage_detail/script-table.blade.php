<script type="text/javascript">
    var vmTable = function() {
        var init_table;

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
                dom: '<"row"<"col-sm-6 col-md-6 col-lg-6"l><"col-xs-3 col-md-3 col-lg-3 text-center"B><"col-xs-3 col-md-3 col-lg-3 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                  text: '+ Create Object',
                  className: 'btn btn-primary mt-3',
                  action: function(e, dt, node, config) {
                    showModal('modalCenter')
                  }
                }],
                select: {
                    // Select style
                    style: 'multi'
                }
            });

            // init_table.on('click', '.select-all', function (e) {

            //     init_table.rows().iterator('row', function(context, index){
            //         var node = $(this.row(index).data());
            //         console.log(node[0].name);
            //     });

            //     init_table.button().add( 0, {
            //         text: '<span class="tf-icons ti ti-sm ti-trash-x text-white mb-1"></span>',
            //         className: 'btn btn-sm btn-danger mt-3',
            //         action: function ( e, dt, button, config ) {
            //             dt.ajax.reload();
            //         },
            //         // text: 'Reload table'
            //     } );
            // });
        }
    }();
</script>