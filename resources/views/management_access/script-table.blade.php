<script type="text/javascript">
    var accessTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
        });

        function format(d) {
    // `d` is the original data object for the row
        return (
            '<dl>' +
            '<dd>' +
            d +
            '</dd>' +
            '</dl>'
        );
        }

        function strtrunc(str, max, add){
           add = add || '...';
           return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
        };


        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: `{{ url('management-access/dt') }}`,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        data: 'name',
                        width: '20%'
                    },
                    {
                        data: 'sshkey',
                        width: '50%',
                        className: 'sshk',
                        render: function(data, type, full, meta) {

                            return `<div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item" style="background: transparent !important;">
                                <h2 class="accordion-header" id="flush-headingOne">
                                  <button class="accordion-button collapsed fw-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-${full['DT_RowIndex']}" aria-expanded="false" aria-controls="flush-collapseOne" style="background: transparent !important; ">
                                   <span class="trunc-${full['DT_RowIndex']} td-text truncate">
                                        ${data}
                                    <span>
                                  </button>
                                </h2>
                                <div id="flush-${full['DT_RowIndex']}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                    <div class="p-1">
                                        <a href="#" data-ssh="${full['sshkey']}" class="btn btn-sm btn-label-primary btn-icon p-1 btn-copy" title="Copy SSH Key">
                                            <span class="svg-icon svg-icon-md power-btn-action">
                                                <i class="menu-icon tf-icons ti ti-xs ti-copy text-primary m-2" ></i>
                                            </span>
                                        </a>
                                        <a href="{{ url('/management-access/') }}/${full['id']}" title="Start" class="btn btn-delete btn-sm btn-clean btn-label-danger btn-icon p-1" title="Start">
                                            <span class="svg-icon svg-icon-md power-btn-action">
                                                <i class="menu-icon tf-icons ti ti-xs ti-trash-x text-danger m-2" ></i>
                                            </span>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                              </div>
                            </div>`;
                        }

                    },
                ],
                columnDefs: [{
                        targets: 0,
                        searchable: true,
                        orderable: true,
                        // responsivePriority: 0,
                    },
                    {
                        targets: 1,
                        searchable: true,
                        orderable: true,
                        // className: 'hidden'
                        // responsivePriority: 6,
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                // dom: '<"toolbar">frtip',
                dom: '<"row"<"col-sm-6 col-md-6 col-lg-6"l><"col-xs-3 col-md-3 col-lg-3 text-center"B><"col-xs-3 col-md-3 col-lg-3 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                  text: '+ Create SSH Key',
                  className: 'btn btn-primary mt-3',
                  action: function(e, dt, node, config) {
                    showModal('modalCenter')
                  }
                }],
                select: {
                    style: 'multi'
                },
            });

            init_table.on('show.bs.collapse', 'td.sshk > .accordion', function (e) {
                let data = init_table.row(e.target.closest('tr')).data();
                $('.trunc-' + data['DT_RowIndex']).removeClass('truncate');
            });

            init_table.on('hide.bs.collapse', 'td.sshk > .accordion', function (e) {
                    let data = init_table.row(e.target.closest('tr')).data();
                    $('.trunc-' + data['DT_RowIndex']).addClass('truncate');
            });
        }
    }();

</script>
