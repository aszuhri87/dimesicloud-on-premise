<script>
    // cpu usage
    var options = {
        series: [7],
        chart: {
            type: 'radialBar',
            offsetY: -45,
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#e7e7e7",
                    strokeWidth: '100%',
                    margin: 1, // margin is in pixels
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: 50,
                        fontSize: '22px'
                    }
                }
            }
        },
        grid: {
            padding: {
                top: -10
            }
        },
        fill: {
            type: 'solid',
            colors: ['#62D6C5']
        },
        labels: ['Average Results'],
        subtitle: {
            offsetY: 130,
            text: (new Date()).toString(),
            align: 'center',
        },
    };

    var chart = new ApexCharts(document.querySelector("#cpuRadial"), options);
    chart.render();

    // Memory Usage
    var options = {
        series: [76],
        chart: {
            type: 'radialBar',
            offsetY: -20,
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#e7e7e7",
                    strokeWidth: '97%',
                    margin: 5, // margin is in pixels
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px'
                    }
                }
            }
        },
        grid: {
            padding: {
                top: -10
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

    // Disk Size

    var options = {
        series: [76],
        chart: {
            type: 'radialBar',
            offsetY: -20,
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: "#e7e7e7",
                    strokeWidth: '97%',
                    margin: 5, // margin is in pixels
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px'
                    }
                }
            }
        },
        grid: {
            padding: {
                top: -10
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
</script>
