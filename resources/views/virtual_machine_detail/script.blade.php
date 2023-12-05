<script>
    $(document).ready(function() {
        var series_config = $(".text-date").text().split(', ')
        var series_config_2 = $(".text-date-2").text().split(', ')


        console.log(series_config);
        // console.log(data_sess['ticket']);

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
            //   $(".text-date2").text(selText);

              getSeries(series_config[0].toLowerCase(), series_config[1])
            });

            $(".filter-date-2").on('click', function(e) {
              e.preventDefault(); // cancel the link behaviour
              var selText = $(this).text();
              let series_config_2 = $(this).text().split(', ');

              console.log(series_config_2);
            //   $(".text-date").text(selText);
              $(".text-date-2").text(selText);

              getSeriesDisk(series_config_2[0].toLowerCase(), series_config_2[1])
            });

            $('.console').on('click', function(e){
                e.preventDefault();
                let data_sess = {!! json_encode(Session::get('data')) !!};

                $.ajax({
                    type: "GET",
                    url: "https://172.16.200.11/?console=kvm&novnc=1&vmid=200081&vmname=anto-vm1&node=R230&resize=off&cmd=",
                    crossDomain: true,
                    // withCredentials: true,
                    dataType: 'jsonp',
                    beforeSend: function(xhr) {
                        xhr.withCredentials = false;
                        xhr.setRequestHeader("Cookie", 'PVEAuthCookie='+ data_sess['ticket']);
                    },
                    success: function(data) {
                        console.log(data);
                        var iframeDoc = document.querySelector('#console-iframe').contentWindow.document;
                        iframeDoc.open('text/html', 'replace');
                        iframeDoc.write(data);
                        iframeDoc.close();
                    }
                });

            //     let cookie = Cookies.set('PVEAuthCookie', JSON.stringify(data_sess['ticket']));

            //     $.ajax({
            //         type: "GET",
            //         url: "https://172.16.200.11/?console=kvm&novnc=1&vmid=200081&vmname=anto-vm1&node=R230&resize=off&cmd=",
            //         contentType: "application/json",
            //         beforeSend: function(xhr, settings){
            //                 xhr.setRequestHeader("Cookie", encodeURIComponent(cookie));},
            //         withCredentials: true,
            //         success: function(data){
            //             $(".console-iframe").attr('src',"https://172.16.200.201:8086/?console=kvm&novnc=1&vmid=200081&vmname=anto-vm1&node=R230&resize=off&cmd=")
            //             console.log('yes');
            //         }
            //     });

            //     // console.log("https://172.16.200.11/?console=kvm&novnc=1&vmid=200081&vmname=anto-vm1&node=R230&resize=off&cmd=?cookie=" + cookie)

            //     // $('#console-iframe').attr('src', "https://172.16.200.11/?console=kvm&novnc=1&vmid=200081&vmname=anto-vm1&node=R230&resize=off&cmd=&vncticket="+ encodeURIComponent(cookie))
            //     // console.log($.cookie('PVEAuthCookie', data_sess['ticket']));

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
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                offsetY: 60,
                                fontSize: '22px',
                                formatter: function(val) {
                                    return val
                                },
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
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                offsetY: 60,
                                fontSize: '22px',
                                formatter: function(val) {
                                    return val
                                },
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
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                offsetY: 60,
                                fontSize: '22px',
                                formatter: function(val) {
                                    return val
                                },
                            },
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
        diskLineChart = (list_series_diskwrite, list_series_diskread, list_categories) => {
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
                    url: `{{ url('virtual_machine/resources') }}/${node}/${vmid}`,
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
            let vmid = '{{ Request::segment(3) }}'

            $.ajax({
                    url: `{{ url('virtual-machine-series') }}/${node}/${vmid}/${unit}/${type}`,
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
        getSeriesDisk = (unit, type) => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'


            $.ajax({
                    url: `{{ url('virtual-machine-series-disk') }}/${node}/${vmid}/${unit}/${type}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    // cpuLineChart(res.data.cpu, res.data.category)
                    // memoryLineChart(res.data.mem, res.data.category)
                    // networkLineChart(res.data.netin, res.data.netout, res.data.category)
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
            $.ajax({
                    url: `{{ url('virtual-machine-current') }}/${node}/${vmid}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    var cpu = `${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`;
                    var mem = bytesToSize(res.data.mem) + ' of ' + bytesToSize(res.data.maxmem);
                    var disk = bytesToSize(res.data.maxdisk);

                    console.log(res.data);

                    cpuRadialChart(cpu);
                    memoryRadialChart(mem);
                    diskRadialChart(disk);

                })
        },
        getCurrentStatus = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}'
            $.ajax({
                    url: `{{ url('virtual-machine-current') }}/${node}/${vmid}`,
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
        getNetwork = () => {
            let node = '{{ Request::segment(2) }}';
            let vmid = '{{ Request::segment(3) }}';
            $.ajax({
                    url: `{{ url('virtual-machine-network') }}/${node}/${vmid}`,
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
            $.ajax({
                    url: `{{ url('virtual-machine-os') }}/${node}/${vmid}`,
                    type: 'get',
                })
                .done(function(res, xhr, meta) {
                    $("#image-info").text(`${res.data['pretty-name']} ${res.data.machine}`)
                    $("#kernel-info").text(res.data['kernel-release'])

                })
                .fail(function(res, error) {
                    // toastr.error(res.responseJSON.message, 'Error')

                    console.log(res.responseJSON);
                })
                .always(function() {

                });
        }
</script>
