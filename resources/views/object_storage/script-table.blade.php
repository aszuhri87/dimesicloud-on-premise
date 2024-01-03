<script type="text/javascript">
    var vmTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
        });

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('object-storage/dt') }}",
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
                        data: 'name'
                    },
                    {
                        data: 'updated_at',
                        width: '20%'
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
                      render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                      },
                      checkboxes: {
                        selectRow: true,
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                      }
                    },
                    {
                        targets: 1,
                        data: "vmid",
                        render: function(data, type, full, meta) {
                            return `
					        	<a href="{{ url('object-storage') }}/${full['name']}/detail" class="d-flex mt-3">
                                    <span class="tf-icons ti ti-folders text-primary"></span> <p class="text-dark mx-1"> ${ full['name']} </p>
					        	</a>
					        `
                        }
                    },
                    {
                        targets: -1,
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        data: "name",
                        render: function(data, type, full, meta) {
                            let is_running = full['status'] === 'running';
                            return `
                                <div class="">
                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                        style="width:38px; height:38px;" data-bs-toggle="dropdown">
                                        <span class="tf-icons ti-xs ti ti-dots-vertical text-center"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ url('object-storage/${data}/delete') }}"
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
                  text: '+ Create Bucket',
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
        }
    }();
</script>
