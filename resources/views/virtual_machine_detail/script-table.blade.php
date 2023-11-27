<script type="text/javascript">
    var DocsCategoryTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
            actionTable();
        });

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('monitoring-vm/dt') }}",
                    headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                },
          columns: [
                { defaultContent: '-'},
                { data: 'name'},
                { data: 'ip' },
                { data: 'vmid' },
                { data: 'node' },
                { data: 'maxdisk' },
                { data: 'mem' },
                { data: 'maxmem' },
                { data: 'cpu' },
                { data: 'maxcpu' },
                { data: 'uptime' },
                { data: 'status' },
                { defaultContent: '' }
          ],
          columnDefs: [
            {
              // Label
              targets: -2,
			  data:'status',
			  render: function(data, type, full, meta){
			  	return data == 'running' ?
			  		`<span class="badge bg-label-primary">Running</span>`:
			  		`<span class="badge bg-label-danger">Stopped</span>`
			  }
            },
            {
                targets: -1,
                searchable: false,
                orderable: false,
                className: "text-center",
                data: "vmid",
                render : function(data, type, full, meta) {
                    return `
                        <div class="d-flex" role="group" aria-label="Basic example">
                            <div class="p-1">
                                <a href="{{ url('admin/disposition-document') }}/${data}" title="Edit" class="btn  btn-edit btn-sm btn-clean btn-icon p-1" title="Edit">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-power text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="p-1">
                                <a href="{{ url('admin/disposition-document') }}/${data}" title="Detail" class="btn btn-detail btn-sm btn-clean btn-icon p-1" data-toggle="tooltip">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-refresh-dot text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ url('admin/disposition-document') }}/${data}" title="Detail" class="btn btn-detail btn-sm btn-clean btn-icon p-1" data-toggle="tooltip">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-recharging text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    `
                }
            }
          ],
          order: [[1, 'desc']],
          dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          select: {
            // Select style
            style: 'multi'
          }
        });
    }
}();
</script>
