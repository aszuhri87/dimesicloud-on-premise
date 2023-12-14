<script>
    $(document).ready(function() {
        var series_config = $(".text-date").text().split(', ')
        var series_config_2 = $(".text-date-2").text().split(', ')

        getSeries(series_config[0].toLowerCase(), series_config[1])
        getSeriesCpu(series_config_2[0].toLowerCase(), series_config_2[1])

        getOS()
        setInterval(function() {
            getCurrentStatus()
        }, 1000)

        setInterval(getSeries(series_config[0].toLowerCase(), series_config[1]), 10000)
        setInterval(getSeriesCpu(series_config_2[0].toLowerCase(), series_config_2[1]), 10000)

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
            //   $(".text-date2").text(selText);

              getSeries(series_config[0].toLowerCase(), series_config[1])
            });

            $(".filter-date-2").on('click', function(e) {
              e.preventDefault(); // cancel the link behaviour
              var selText = $(this).text();
              let series_config_2 = $(this).text().split(', ');

            //   $(".text-date").text(selText);
              $(".text-date-2").text(selText);

              getSeriesCpu(series_config_2[0].toLowerCase(), series_config_2[1])
            });

            $('.console').on('click', function(e){
                e.preventDefault();
                let data_sess = {!! json_encode(Session::get('data')) !!};

                Cookies.set('PVEAuthCookie', data_sess['ticket'], {domain: '.dimensi.com'})
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
                        // dataLabels: {
                        //     name: {
                        //         show: false
                        //     },
                        //     value: {
                        //         offsetY: 60,
                        //         fontSize: '22px',
                        //         formatter: function(val) {
                        //             return val
                        //         },
                        //     }
                        // },
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
                // subtitle: {
                //     offsetY: 110,
                //     text: d + '/' + m + '/' + y + ' | ' + h + ':' + mn,
                //     align: 'center',
                //     fontSize: '15px'
                // },
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
                        },
                        // dataLabels: {
                        //     name: {
                        //         show: false
                        //     },
                        //     value: {
                        //         offsetY: 60,
                        //         fontSize: '22px',
                        //         formatter: function(val) {
                        //             return val
                        //         },
                        //     }
                        // }
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
                        },
                        // dataLabels: {
                        //     name: {
                        //         show: false
                        //     },
                        //     value: {
                        //         offsetY: 60,
                        //         fontSize: '22px',
                        //         formatter: function(val) {
                        //             return val
                        //         },
                        //     },
                        // }
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
            let cardColor, headingColor, labelColor, borderColor, legendColor;

            cardColor = '#4B465C';
            headingColor = '#4B465C';
            labelColor = '#4B465C';
            legendColor = '#4B465C';
            borderColor = '#DBDADE';


            // Color constant
            const chartColors = {
              column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
              },
              donut: {
                series1: '#fee802',
                series2: '#3fd0bd',
                series3: '#826bf8',
                series4: '#2b9bf4'
              },
              area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
              }
            };
            var options = {
                    chart: {
                        height: 400,
                        type: 'area',
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: false,
                        curve: 'straight'
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
                    colors: ['#60F2CA', '#A4F8CD'],
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
                        opacity: 1,
                        type: 'solid'
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
        cpuLineChart = (list_series_cpu, list_series_io, list_categories) => {
            let cardColor, headingColor, labelColor, borderColor, legendColor;

            cardColor = '#4B465C';
            headingColor = '#4B465C';
            labelColor = '#4B465C';
            legendColor = '#4B465C';
            borderColor = '#DBDADE';


            // Color constant
            const chartColors = {
              column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
              },
              donut: {
                series1: '#fee802',
                series2: '#3fd0bd',
                series3: '#826bf8',
                series4: '#2b9bf4'
              },
              area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
              }
            };
            var options = {
                    chart: {
                        height: 400,
                        type: 'area',
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: false,
                        curve: 'straight'
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
                    colors: ['#60F2CA', '#A4F8CD'],
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
                        opacity: 1,
                        type: 'solid'
                    },
                    tooltip: {
                        shared: false
                    }
                };

            var chart = new ApexCharts(document.querySelector('#cpuGraph'), options);
            chart.render();

            chart.updateSeries([
                {
                    name: 'CPU usage',
                    data: list_series_cpu
                },
                {
                    name: 'IO delay',
                    data: list_series_io
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

            $.ajax({
                    url: `{{ url('/node-detail') }}/${node}/${unit}/${type}/resources`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    // cpuLineChart(res.data.cpu, res.data.category)
                    // memoryLineChart(res.data.mem, res.data.category)
                    networkLineChart(res.data.netin, res.data.netout, res.data.category)
                    // diskLineChart(res.data.diskwrite, res.data.diskread, res.data.category)
                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getSeriesCpu = (unit, type) => {
            let node = '{{ Request::segment(2) }}';

            $.ajax({
                    url: `{{ url('/node-detail') }}/${node}/${unit}/${type}/resources`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    cpuLineChart(res.data.cpu, res.data.iowait, res.data.category)
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
            $.ajax({
                    url: `{{ url('/node-detail') }}/${node}/profile`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#cpu-info").text(`${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`)
                    $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
                    $("#disk-info").text(`${bytesToSize(res.data.disk_used)} of ${bytesToSize(res.data.disk_total)}`)

                    var cpu = `${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`;
                    var mem = bytesToSize(res.data.mem) + ' of ' + bytesToSize(res.data.maxmem);
                    var disk = bytesToSize(res.data.disk_used) + ' of ' + bytesToSize(res.data.disk_total);

                    $('.data-label-cpu').text(cpu)
                    $('.data-label-mem').text(mem)
                    $('.data-label-disk').text(disk)

                    var cpu_percent = (res.data.cpu * 100).toFixed(2)
                    var mem_percent = ((res.data.mem / res.data.maxmem) * 100).toFixed(2)
                    var disk_percent = ((res.data.disk_used / res.data.disk_total) * 100).toFixed(2)

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
            $.ajax({
                    url: `{{ url('/node-detail') }}/${node}/${vmid}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#vm-name").text(res.data.name.toUpperCase())
                    $("#cpu-info").text(`${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`)
                    $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
                    $("#disk-info").text(`${bytesToSize(res.data.maxdisk)}`)
                    $("#uptime").text(secondsToDhms(res.data.uptime))

                    // var cpu = res.data.cpu * 100;

                    // cpuLineChart(cpu);

                    let element = res.data.status == 'running' ?
                        `<span class="badge badge-primary">
                                    ${res.data.status.toUpperCase()}
                                </span>` :
                        `<span class="badge badge-danger">
                                    ${res.data.status.toUpperCase()}
                                </span>`;

                    $("#status-info").html(element)

                })
                .fail(function(res, error) {
                    toastr.error(res.responseJSON.message, 'Error')
                })
                .always(function() {

                });
        },
        getOS = () => {
            let node = '{{ Request::segment(2) }}';
            $.ajax({
                    url: `{{ url('/node-detail') }}/${node}/profile`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#image-info").text(`${res.data['image']}`)
                    $("#kernel-info").text(res.data['kernel'])
                    $("#vm-name").text(`${node}`)
                    $("#cpu-info").text(`${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`)
                    $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
                    $("#disk-info").text(`${bytesToSize(res.data.disk_used)} of ${bytesToSize(res.data.disk_total)}`)
                    $("#ip-info").text(res.data.ip)

                    if(res.data['kernel'].includes('Linux') == true){
                        $('#img-src').remove();
                        $('.os_logo').append(`<img src="{{ asset('assets/os_logo/linux.svg')}}" alt="" style="margin-top: 25%; margin-left: 11%">`)
                    }
                })
                .fail(function(res, error) {
                })
                .always(function() {

                });
        }
</script>
