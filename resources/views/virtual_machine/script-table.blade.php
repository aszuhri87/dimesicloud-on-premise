<script type="text/javascript">
    var vmTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
            actionTable();
        });

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('virtual-machine/dt') }}",
                    headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                },
          columns: [
                { data: 'name'},
                { data: 'ip' },
                // { data: 'vmid' },
                { data: 'node' },
                { data: 'maxdisk' },
                { data: 'mem' },
                { data: 'maxmem' },
                { data: 'cpu' },
                { data: 'maxcpu' },
                // { data: 'uptime' },
                { data: 'status' },
                { defaultContent: '' }
          ],
          columnDefs: [
            {
				targets:0,
				data:'id',
				render : function(data, type, full, meta){
					return `
						<a href="{{ url('virtual-machine-graph') }}/${full['node']}/${full['vmid']}">
							<p class="font-weight-bold text-primary-75 text-hover-primary font-size-lg mb-1">${ full['name'].toUpperCase() }</p>
						</a>
					`
				}
			},
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
                                <a href="{{ url('/power') }}/${full['node']}/${full['vmid']}/start" title="Start" class="btn  btn-start btn-sm btn-clean btn-icon p-1" title="Start">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-player-play text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="p-1">
                                <a href="{{ url('/power') }}/${full['node']}/${full['vmid']}/shutdown" title="Shutdown" class="btn  btn-shutdown btn-sm btn-clean btn-icon p-1" title="Shutdown">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-power text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="p-1">
                                <a href="{{ url('/power') }}/${full['node']}/${full['vmid']}/reboot" title="Reboot" class="btn btn-reboot btn-sm btn-clean btn-icon p-1" data-toggle="tooltip">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="menu-icon tf-icons ti ti-refresh-dot text-primary p-1" style="background-color: #0073C029; border-radius: 4px;"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="p-1">
                                <a href="{{ url('/power') }}/${full['node']}/${full['vmid']}/force-shutdown" title="Force Shutdown" class="btn btn-force-shutdown btn-sm btn-clean btn-icon p-1" data-toggle="tooltip">
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
