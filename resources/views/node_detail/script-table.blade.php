<script type="text/javascript">
    var diskTable = function() {
        var init_table;
        var node = '{{ Request::segment(2) }}';

        $(document).ready(function() {
            initTable();
        });

        const initTable = () => {
            init_table = $('#init-table').DataTable({
                ajax: {
                    type: 'POST',
                    url: `{{ url('node-detail/${node}/list-disk') }}`,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                searching: false,
                lengthChange: false,
                columns: [
                    {
                        data: 'devpath'
                    },
                    {
                        data: 'used'
                    },
                    {
                        data: 'model'
                    },
                    {
                        data: 'serial'
                    },
                    {
                        data: 'size'
                    },
                    {
                        data: 'wearout'
                    },
                ],
                columnDefs: [
                    {
                        targets:4,
                        data:'used',
                        render: function(data, type, full, meta){
                            return bytesToSize(data)
                        }
                    },
                    // {
                    //     targets:5,
			        // 	data:'wearout',
			        // 	render: function(data, type, full, meta){
                    //         return `${data} %`
			        // 	}
                    // },
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
</script>
