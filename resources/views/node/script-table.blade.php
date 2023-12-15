<script type="text/javascript">
    var vmTable = function() {
        var init_table;

        $(document).ready(function() {
            initTable();
            // actionTable();
        });

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: "{{ url('node/dt') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'cpu'
                    },
                    {
                        data: 'maxcpu'
                    },
                    {
                        data: 'mem'
                    },
                    {
                        data: 'maxmem'
                    },
                    {
                        data: 'maxdisk'
                    },
                    // { data: 'uptime' },
                    {
                        data: 'status'
                    },
                    // {
                    //     defaultContent: ''
                    // }
                ],
                columnDefs: [{
                        targets: 0,
                        data: 'name',
                        render: function(data, type, full, meta) {
                            return `
						<a href="{{ url('node-detail') }}/${full['name']}">
							<p class="font-weight-bold text-primary-75 text-hover-primary font-size-lg mb-1">${ full['name'].toUpperCase() }</p>
						</a>
					`
                        }
                    },
                    {
                        targets:2,
                        data:'cpu',
                        render: function(data, type, full, meta){
                            return `${data.toFixed(2)} %`
                        }
                    },
                    {
                        targets:4,
			        	data:'mem',
			        	render: function(data, type, full, meta){
                            return bytesToSize(data)
			        	}
                    },
                    {
                        targets:5,
			        	data:'maxmem',
			        	render: function(data, type, full, meta){
                            return bytesToSize(data)
			        	}
                    },
                    {
                        targets:6,
                        data:'maxdisk',
                        render: function(data, type, full, meta){
                            return bytesToSize(data)
                        }
                    },
                    {
                        // Label
                        targets: -1,
                        data: 'status',
                        render: function(data, type, full, meta) {
                            return data == 1 ?
                                `<span class="badge bg-label-primary">Online</span>` :
                                `<span class="badge bg-label-danger">Offline</span>`
                        }
                    },
                ],
                order: [
                    [0, 'asc']
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                select: {
                    // Select style
                    style: 'multi'
                }
            });
        }
    }();
</script>
