<script>
    var today = new Date();
    var d = today.getDate().toString();
    var m = today.getMonth().toString();
    var y = today.getFullYear().toString();
    var h = today.getHours().toString();
    var mn = today.getMinutes().toString();

    // cpu usage
    var options = {
        series: [7],
        chart: {
            type: 'radialBar',
            offsetY: -5,
            sparkline: {
                enabled: true
            },
            width: '100%',
            height: 'auto'
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
                top: -40
            }
        },
        fill: {
            type: 'solid',
            colors: ['#62D6C5']
        },
        labels: ['Average Results'],
        subtitle: {
            offsetY: 110,
            text: d + '/' + m + '/' + y + ' | ' + h + ':' + mn,
            align: 'center',
            fontSize: '15px'
        },
    };

    var chart = new ApexCharts(document.querySelector("#cpuRadial"), options);
    chart.render();

    // Memory Usage
    var options = {
        series: [7],
        chart: {
            type: 'radialBar',
            offsetY: -5,
            sparkline: {
                enabled: true
            },
            width: '100%',
            height: 'auto'
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
                top: -40
            }
        },
        fill: {
            type: 'solid',
            colors: ['#62D6C5']
        },
        labels: ['Average Results'],
        subtitle: {
            offsetY: 110,
            text: d + '/' + m + '/' + y + ' | ' + h + ':' + mn,
            align: 'center',
            fontSize: '15px'
        },
    };

    var chart = new ApexCharts(document.querySelector("#memoryRadial"), options);
    chart.render();

    // Disk Size

    var options = {
        series: [7],
        chart: {
            type: 'radialBar',
            offsetY: -5,
            sparkline: {
                enabled: true
            },
            width: '100%',
            height: 'auto'
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
                top: -40
            }
        },
        fill: {
            type: 'solid',
            colors: ['#62D6C5']
        },
        labels: ['Average Results'],
        subtitle: {
            offsetY: 110,
            text: d + '/' + m + '/' + y + ' | ' + h + ':' + mn,
            align: 'center',
            fontSize: '15px'
        },
    };

    var chart = new ApexCharts(document.querySelector("#diskRadial"), options);
    chart.render();
</script>
