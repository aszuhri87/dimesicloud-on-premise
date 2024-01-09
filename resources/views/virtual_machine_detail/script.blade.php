<script>
    $(document).ready(function() {
        var series_config = $(".text-date").text().split(', ')
        var series_config_2 = $(".text-date-2").text().split(', ')


        getSeries(series_config[0].toLowerCase(), series_config[1])
        getSeriesDisk(series_config_2[0].toLowerCase(), series_config_2[1])

        getNetwork()

        getOS()
        setInterval(function() {
            getCurrentStatus()
        }, 1000)

        setInterval(getSeries(series_config[0].toLowerCase(), series_config[1]), 10000)
        setInterval(getSeriesDisk(series_config_2[0].toLowerCase(), series_config_2[1]), 10000)


        getCurrentChart()
        setInterval(getCurrentChart, 10000)
        initAction()
    })

    const initAction = () => {

            $(".filter-date").on('click', function(e) {
              e.preventDefault(); // cancel the link behaviour
              var selText = $(this).text();
              let series_config = $(this).text().split(', ');
              $(".text-date").text(selText);

              getSeries(series_config[0].toLowerCase(), series_config[1])
            });

            $(".filter-date-2").on('click', function(e) {
              e.preventDefault(); // cancel the link behaviour
              var selText = $(this).text();
              let series_config_2 = $(this).text().split(', ');

              $(".text-date-2").text(selText);

              getSeriesDisk(series_config_2[0].toLowerCase(), series_config_2[1])
            });

            $(document).on('click', '.btn-copy', function(e) {
                e.preventDefault()
                // var textToCopy = $('#cpy').val();
                var textToCopy = $(this).attr('data-ssh');

                if (textToCopy != null || textToCopy != " " || textToCopy != ""){
                    toastr.success("SSH Key Copied");
                } else {
                    toastr.error("Failed Copying SSH Key");
                }

                var tempTextarea = $('<textarea>');
                $('body').append(tempTextarea);
                tempTextarea.val(textToCopy).select();
                document.execCommand('copy');
                tempTextarea.remove();
            });

            $('.console').on('click', function(e){
                e.preventDefault();
                let data_sess = {!! json_encode(Session::get('data')) !!};

                Cookies.set('PVEAuthCookie', data_sess['ticket'], {domain: "{{env('BASE_DOMAIN')}}"})
                window.open($(this).attr('href'), "_blank", "location=yes")
            })

            $(document).on('click', '.btn-console', function(event) {
                event.preventDefault();
                let url = $(this).attr('href')
                window.open(url, '_blank', 'location=yes');
            });

            $(document).on('click', '.btn-start', function(event) {
                event.preventDefault();
                let url = $(this).attr('href')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You will start virtual machine!",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Start!",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                                url: url,
                                type: 'POST',
                            })
                            .done(function(res, xhr, meta) {
                                toastr.success(res.message);
                            })
                            .fail(function(res, error) {
                                toastr.error(res.responseJSON.message, 'Error')
                            })
                            .always(function() {

                            });

                    }
                });
            });

            $(document).on('click', '.btn-restart', function(event) {
                event.preventDefault();
                let url = $(this).attr('href')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You will restart virtual machine!",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Restart!",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                                url: url,
                                type: 'POST',
                            })
                            .done(function(res, xhr, meta) {
                                toastr.success(res.message);
                            })
                            .fail(function(res, error) {
                                toastr.error(res.responseJSON.message, 'Error')
                            })
                            .always(function() {

                            });

                    }
                });
            });

            $(document).on('click', '.btn-shutdown', function(event) {
                event.preventDefault();
                let url = $(this).attr('href')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You will shutdown virtual machine!",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Shutdown!",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                                url: url,
                                type: 'POST',
                            })
                            .done(function(res, xhr, meta) {
                                toastr.success(res.message);
                            })
                            .fail(function(res, error) {
                                toastr.error(res.responseJSON.message, 'Error')
                            })
                            .always(function() {

                            });

                    }
                });
            });

            $(document).on('click', '.btn-delete', function(event){
                event.preventDefault();
                var url = $(this).attr('href');

                Swal.fire({
                    title: 'Delete?',
                    text: "Are you sure removing this data? this action can't be undone!",
                    icon: 'warning',
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
                            type: 'DELETE',
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
            });


            $('#form-submit').submit(function(event){
                event.preventDefault();

                $.ajax({
                    url: '/management-access',
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                })
                .done(function(res, xhr, meta) {
                    toastr.success(res.message)

                    $('#init-table').DataTable().ajax.reload();

                    hideModal('modalCenter');
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message)
                })
                .always(function() { });
            });
        },
        cpuRadialChart = (cpu = []) => {
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
                labels: ['']
            };

            var chart = new ApexCharts(document.querySelector("#cpuRadial"), options);
            chart.render();
            chart.updateSeries([cpu])
        },
        memoryRadialChart = (mem = []) => {
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
                labels: [''],
            };

            var chart = new ApexCharts(document.querySelector("#memoryRadial"), options);
            chart.render();
            chart.updateSeries([mem])
        },
        diskRadialChart = (disk = []) => {
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
                labels: [''],
            };

            var chart = new ApexCharts(document.querySelector("#diskRadial"), options);
            chart.render();
            chart.updateSeries([disk])

        },
        networkLineChart = (list_series_netin, list_series_netout, list_categories) => {
            var options = {
                    chart: {
                        height: 400,
                        type: 'area',
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        },
                        stacked: true
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        curve: 'straight',
                        width: 1.5
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'start',
                        labels: {
                            colors: '#4B465C',
                            useSeriesColors: false
                        }
                    },
                    grid: {
                        borderColor: '#DBDADE',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    colors: ['#0073C0', '#60f2ca'],
                    series: [{
                            name: 'Upload',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        },
                        {
                            name: 'Download',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        },
                    ],
                    xaxis: {
                        categories: [
                            '7/12',
                            '8/12',
                            '9/12',
                            '10/12',
                            '11/12',
                            '12/12',
                            '13/12',
                            '14/12',
                            '15/12',
                            '16/12',
                            '17/12',
                            '18/12',
                            '19/12',
                            '20/12'
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#4B465C',
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#4B465C',
                                fontSize: '13px'
                            }
                        }
                    },
                    fill: {
                        type: ['solid', 'gradient'],
                        gradient: {
                            shared: 'dark',
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                        }
                    },
                    tooltip: {
                        shared: false
                    }
                };

            var chart = new ApexCharts(document.querySelector('#networkGraph'), options);
            chart.render();

            chart.updateSeries([{
                    name: 'Upload',
                    data: list_series_netin
                },
                {
                    name: 'Download',
                    data: list_series_netout
                }
            ])
            chart.updateOptions({
                xaxis: {
                    type: 'datetime',
                    categories: list_categories,
                    labels: {
                        datetimeUTC: false,
                    }
                },
                yaxis: {
                    opposite: false,
                    labels: {
                        formatter: (value) => {
                            return value
                        },
                    }
                }
            })
        },
        diskLineChart = (list_series_diskwrite, list_series_diskread, list_categories) => {
            var options = {
                    chart: {
                        height: 400,
                        type: 'area',
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        },
                        stacked: true
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        curve: 'straight',
                        width: 1.5
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'start',
                        labels: {
                            colors: '#4B465C',
                            useSeriesColors: false
                        }
                    },
                    grid: {
                        borderColor: '#DBDADE',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    colors: ['#0073C0', '#60f2ca'],
                    series: [{
                            name: 'Upload',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        },
                        {
                            name: 'Download',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        },
                    ],
                    xaxis: {
                        categories: [
                            '7/12',
                            '8/12',
                            '9/12',
                            '10/12',
                            '11/12',
                            '12/12',
                            '13/12',
                            '14/12',
                            '15/12',
                            '16/12',
                            '17/12',
                            '18/12',
                            '19/12',
                            '20/12'
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#4B465C',
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#4B465C',
                                fontSize: '13px'
                            }
                        }
                    },
                    fill: {
                        type: ['solid', 'gradient'],
                        gradient: {
                            shared: 'dark',
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                        }
                    },
                    tooltip: {
                        shared: false
                    }
                };

            var chart = new ApexCharts(document.querySelector('#diskGraph'), options);
            chart.render();

            chart.updateSeries([
                {
                    name: 'Read',
                    data: list_series_diskread
                },
                {
                    name: 'Write',
                    data: list_series_diskwrite
                },
            ])
            chart.updateOptions({
                xaxis: {
                    type: 'datetime',
                    categories: list_categories,
                    labels: {
                        datetimeUTC: false,
                    }
                },
                yaxis: {
                    opposite: false,
                    labels: {
                        formatter: (value) => {
                            return value
                        },
                    }
                }
            })
        },
        getMonitor = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            $.ajax({
                    url: `{{ url('/virtual_machine/resources') }}/${node}/${vmid}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#cpu-info").text(`of ${res.data.cpus} CPU(s)`)
                    $("#cpu-presentace").text(`${(res.data.cpu * 100).toFixed(2)} %`)

                    $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
                    $("#mem-presentace").text(`${(res.data.mem/res.data.maxmem * 100).toFixed(2)} %`)

                    $("#disk-info").text(`${bytesToSize(res.data.maxdisk)}`)

                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getSeries = (unit, type) => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}';
            let node_type = "{{ Request::get('type') }}";

            $.ajax({
                    url: `{{ url('/virtual-machine-series') }}/${node}/${vmid}/${unit}/${type}/${node_type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    networkLineChart(res.data.netin, res.data.netout, res.data.category)
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getSeriesDisk = (unit, type) => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            let node_type = "{{ Request::get('type') }}";

            $.ajax({
                    url: `{{ url('/virtual-machine-series-disk') }}/${node}/${vmid}/${unit}/${type}/${node_type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    diskLineChart(res.data.diskwrite, res.data.diskread, res.data.category)
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getCurrentChart = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            let type = "{{ Request::get('type') }}";

            $.ajax({
                    url: `{{ url('/virtual-machine-current') }}/${node}/${vmid}/${type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    var cpu = `${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`;
                    var mem = bytesToSize(res.data.mem) + ' of ' + bytesToSize(res.data.maxmem);
                    var disk = bytesToSize(res.data.maxdisk);

                    $('.data-label-cpu').text(cpu)
                    $('.data-label-mem').text(mem)
                    $('.data-label-disk').text(disk)

                    var cpu_percent = (res.data.cpu * 100).toFixed(2)
                    var mem_percent = ((res.data.mem / res.data.maxmem) * 100).toFixed(2)
                    var disk_percent = ((res.data.maxdisk / res.data.maxdisk) * 100).toFixed(2)

                    $('#cpuRadial').on('mouseover', function(e){
                        e.preventDefault()
                        $(this).attr('title', cpu_percent + '%')
                    })

                    $('#memoryRadial').on('mouseover', function(e){
                        e.preventDefault()
                        $(this).attr('title', mem_percent + '%')
                    })

                    $('#diskRadial').on('mouseover', function(e){
                        e.preventDefault()
                        $(this).attr('title', disk_percent + '%')
                    })

                    cpuRadialChart(cpu_percent);
                    memoryRadialChart(mem_percent);
                    diskRadialChart(disk_percent);
                })
        },
        getCurrentStatus = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            let type = "{{ Request::get('type') }}";

            $.ajax({
                    url: `{{ url('/virtual-machine-current') }}/${node}/${vmid}/${type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#vm-name").text(res.data.name.toUpperCase())
                    $("#cpu-info").text(`${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`)
                    $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
                    $("#disk-info").text(`${bytesToSize(res.data.maxdisk)}`)
                    $("#uptime").text(secondsToDhms(res.data.uptime))

                    let element = res.data.status == 'running' ?
                        `<span class="badge badge-primary">
                                    ${res.data.status.toUpperCase()}
                                </span>` :
                        `<span class="badge badge-danger">
                                    ${res.data.status.toUpperCase()}
                                </span>`;

                    if(res.data.status === 'running'){
                        $('.btn-running').attr('disabled',true)
                        $('.btn-stopped').attr('disabled',false)
                    }

                    if(res.data.status === 'stopped'){
                        $('.btn-running').attr('disabled',false)
                        $('.btn-stopped').attr('disabled',true)
                    }

                    $("#status-info").html(element)

                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getNetwork = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}';
            let type = "{{ Request::get('type') }}";

            $.ajax({
                    url: `{{ url('/virtual-machine-network') }}/${node}/${vmid}/${type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#ip-info").text(res.data.ip)

                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getOS = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            let type = "{{ Request::get('type') }}"

            $.ajax({
                    url: `{{ url('/virtual-machine-os') }}/${node}/${vmid}/${type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    let name = res.data['id'];

                    if(res.data['id'] == "ubuntu"){
                        $('#img-src').remove();
                        $('.os_logo').append(`<img src="{{ asset('assets/os_logo/${name.toLowerCase()}.svg')}}" alt="" style="margin-top: 25%; margin-left: 9%">`)
                    }

                    $("#image-info").text(`${res.data['pretty-name']} ${res.data.machine}`)
                    $("#kernel-info").text(res.data['kernel-release'])

                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        }
</script>
