<script type="text/javascript">
    var emailTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
        });

        const initTable = () => {
            init_table = $('#email-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('/management-alert/dt_email') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'value'
                    },
                    {
                        defaultContent: ''
                    }
                ],
                columnDefs: [{
                        targets: 0,
                        searchable: true,
                        orderable: true,
                    },
                    {
                        targets: 1,
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        data: "id",
                        width: '20%',
                        render: function(data, type, full, meta) {
                            return `
                                <div class="p-1 text-center">
                                    <a href="{{ url('/management-alert/') }}/${full['id']}" title="Start" class="btn btn-delete btn-sm btn-clean btn-label-danger btn-icon p-1" title="Start">
                                        <span class="svg-icon svg-icon-md power-btn-action">
                                            <i class="menu-icon tf-icons ti ti-xs ti-trash-x text-danger m-2" ></i>
                                        </span>
                                    </a>
                                </div>
                            `
                        }
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                select: {
                    // Select style
                    style: 'multi'
                }
            });
        }
    }();

    const teleTable = () => {
        var init_table_2;

        $(document).ready(function() {
            initTable2();
        });

        const initTable2 = () => {
            init_table_2 = $('#tele-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('/management-alert/dt_telegram') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'value'
                    },
                    {
                        defaultContent: ''
                    }
                ],
                columnDefs: [{
                        targets: 0,
                        searchable: true,
                        orderable: true,
                    },
                    {
                        targets: -1,
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        data: "id",
                        width: '10%',
                        render: function(data, type, full, meta) {
                            return `
                                <div class="p-1 text-center">
                                    <a href="{{ url('/management-alert/') }}/${full['id']}" title="Start" class="btn btn-delete btn-sm btn-clean btn-label-danger btn-icon p-1" title="Start">
                                        <span class="svg-icon svg-icon-md power-btn-action">
                                            <i class="menu-icon tf-icons ti ti-xs ti-trash-x text-danger m-2" ></i>
                                        </span>
                                    </a>
                                </div>
                            `
                        }
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                select: {
                    // Select style
                    style: 'multi'
                }
            });
        }
    };

    $('.btn-tele').on('click', function(e) {
        e.preventDefault()

        $('.list-tele').html(`
            <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                <div class="card-datatable">
                    <table id="tele-table" class="table table-sm border"
                        style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                        <thead>
                            <tr>
                                <th style="font-size: 8pt; width: 90%;">Group ID</th>
                                <th style="font-size: 8pt;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        `);

        teleTable();
    });
</script>
