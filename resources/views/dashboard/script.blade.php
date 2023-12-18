<script>
    var top_vm_cpu_table = null;
    var top_vm_memory_table = null;


    const cpuUsageChart = (data) => {
        var options = {
            series: [0],
            chart: {
                type: 'radialBar',
                offsetY: -5,
                sparkline: {
                    enabled: true
                },

            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#e7e7e7",
                        strokeWidth: '100%',
                        strokeHeight: '100%',
                        margin: -5, // margin is in pixels
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 60,
                            fontSize: '22px'
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                return `${w.config.series[0]} %`
                            }
                        }
                    }
                }
            },
            grid: {
                padding: {
                    top: -20
                }
            },
            fill: {
                type: 'solid',
                colors: ['#62D6C5']
            },
            labels: ['Average Results'],
        };

        var chart = new ApexCharts(document.querySelector("#cpuUsageChart"), options);
        chart.render();

        chart.updateSeries([data.usage.toFixed(2)])
        chart.updateOptions({
            labels: [`of ${data.total} CPU(s)`]
        })
    }

    const ramUsageChart = (data) => {
        var options = {
            series: [0],
            chart: {
                type: 'radialBar',
                offsetY: -5,
                sparkline: {
                    enabled: true
                },

            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#e7e7e7",
                        strokeWidth: '100%',
                        strokeHeight: '100%',
                        margin: -5, // margin is in pixels
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 60,
                            fontSize: '22px'
                        }
                    }
                }
            },
            grid: {
                padding: {
                    top: -20
                }
            },
            fill: {
                type: 'solid',
                colors: ['#62D6C5']
            },
            labels: ['Average Results'],
        };

        var chart = new ApexCharts(document.querySelector("#ramUsageChart"), options);
        chart.render();

        let value = (data.usage / data.total * 100).toFixed(2);
        chart.updateSeries([value])
        chart.updateOptions({
            labels: [`${bytesToSize(data.usage)} of ${bytesToSize(data.total)}`]
        })
    }
    const diskUsageChart = (data) => {
        var options = {
            series: [0],
            chart: {
                type: 'radialBar',
                offsetY: -5,
                sparkline: {
                    enabled: true
                },

            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: "#e7e7e7",
                        strokeWidth: '100%',
                        strokeHeight: '100%',
                        margin: -5, // margin is in pixels
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 60,
                            fontSize: '22px'
                        }
                    }
                }
            },
            grid: {
                padding: {
                    top: -20
                }
            },
            fill: {
                type: 'solid',
                colors: ['#62D6C5']
            }
        };

        var chart = new ApexCharts(document.querySelector("#diskUsageChart"), options);
        chart.render();

        let value = (data.usage / data.total * 100).toFixed(2);
        chart.updateSeries([value])
        chart.updateOptions({
            labels: [`${bytesToSize(data.usage)} of ${bytesToSize(data.total)}`]
        })

    }

    const topVmCpuTable = () => {
        top_vm_cpu_table = $('#top-vm-cpu-table').DataTable({
            columns: [{
                    data: 'name', orderable: false, width:"30%"
                },
                {
                    data: 'node', orderable: false
                },
                {
                    data: 'cpu', class: 'text-center'
                },
                {
                    data: 'status', orderable: false,  class: 'text-center'
                }
            ],
            columnDefs: [{
                    targets: 0,
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `
						<a href="{{ url('virtual-machine-graph') }}/${full['node']}/${full['vmid']}">
							<p class="font-weight-bold text-primary-75 text-hover-primary font-size-lg mb-1">${ full['name'].toUpperCase() }</p>
						</a>
					`
                    }
                },
                {
                    // Label
                    targets: -1,
                    data: 'status',
                    render: function(data, type, full, meta) {
                        return data == 'running' ?
                            `<span class="badge bg-label-primary">Running</span>` :
                            `<span class="badge bg-label-danger">Stopped</span>`
                    }
                },
            ],
            order: [
                [2, 'desc']
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            select: {
                // Select style
                style: 'multi'
            },
            lengthChange: false,
            pageLength: 5
        });
    }

    const topVmMemoryTable = () => {
        top_vm_memory_table = $('#top-vm-memory-table').DataTable({
            columns: [{
                    data: 'name', orderable: false, width:"30%"
                },
                {
                    data: 'node', orderable: false
                },
                {
                    data: 'mem_usage',  class: 'text-center'
                },
                {
                    data: 'maxmem', orderable: false,  class: 'text-center'
                },
                {
                    data: 'status', orderable: false,  class: 'text-center'
                }
            ],
            columnDefs: [{
                    targets: 0,
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `
						<a href="{{ url('virtual-machine-graph') }}/${full['node']}/${full['vmid']}">
							<p class="font-weight-bold text-primary-75 text-hover-primary font-size-lg mb-1">${ full['name'].toUpperCase() }</p>
						</a>
					`
                    }
                },
                {
                    // Label
                    targets: -1,
                    data: 'status',
                    render: function(data, type, full, meta) {
                        return data == 'running' ?
                            `<span class="badge bg-label-primary">Running</span>` :
                            `<span class="badge bg-label-danger">Stopped</span>`
                    }
                },
            ],
            order: [
                [2, 'desc']
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            select: {
                // Select style
                style: 'multi'
            },
            lengthChange: false,
            pageLength: 5
        });
    }

    const widgetNode = (data) => {
        $(".total-node-count").text(data.total);
        $("#running-node-count").text(data.running);
        $("#stopped-node-count").text(data.stopped);
    }

    const widgetVM = (data) => {
        $(".total-vm-count").text(data.total);
        $("#running-vm-count").text(data.running);
        $("#stopped-vm-count").text(data.stopped);
    }

    const getData = () => {
        $.ajax({
                url: "{{ url ('dashboard/statistic-resources')}}",
                type: 'GET',
            })
            .done(function(res, xhr, meta) {
                widgetNode(res.data.node_status)
                widgetVM(res.data.vm_status)

                cpuUsageChart(res.data.cpu)
                ramUsageChart(res.data.memory)
                diskUsageChart(res.data.disk)

                top_vm_cpu_table.clear().rows.add( res.data.top_cpu ).draw();
                top_vm_memory_table.clear().rows.add( res.data.top_memory ).draw();
            })
            .fail(function(res, error) {

            })
            .always(function() {

            });
    }


    $(document).ready(function() {
        getData();
        setInterval(getData, 10000);
        // cpuUsageChart();
        // ramUsageChart();
        // diskUsageChart();
        topVmCpuTable();
        topVmMemoryTable()
    })
</script>
