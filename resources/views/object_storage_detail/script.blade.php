<script>
    /**
     * Statistics Cards
     */

    'use strict';

    (function() {
        let cardColor, shadeColor, labelColor, headingColor, barBgColor, borderColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            labelColor = config.colors_dark.textMuted;
            headingColor = config.colors_dark.headingColor;
            shadeColor = 'dark';
            barBgColor = '#8692d014';
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            labelColor = config.colors.textMuted;
            headingColor = config.colors.headingColor;
            shadeColor = '';
            barBgColor = '#4b465c14';
            borderColor = config.colors.borderColor;
        }

        // Donut Chart Colors
        const chartColors = {
            donut: {
                series1: config.colors.success,
                series2: '#28c76fb3',
                series3: '#28c76f80',
                series4: config.colors_label.success
            }
        };
        // Subscriber Gained Area Chart
        // --------------------------------------------------------------------
        const subscriberGainedEl = document.querySelector('#sas'),
            subscriberGainedConfig = {
                chart: {
                    height: 90,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.1
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [200, 60, 300, 140, 230, 120, 400]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof subscriberGainedEl !== undefined && subscriberGainedEl !== null) {
            const subscriberGained = new ApexCharts(subscriberGainedEl, subscriberGainedConfig);
            subscriberGained.render();
        }

        // Quarterly Sales Area Chart
        // --------------------------------------------------------------------
        const quarterlySalesEl = document.querySelector('#quarterlySales'),
            quarterlySalesConfig = {
                chart: {
                    height: 90,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.danger],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.1
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [200, 300, 160, 250, 130, 400]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof quarterlySalesEl !== undefined && quarterlySalesEl !== null) {
            const quarterlySales = new ApexCharts(quarterlySalesEl, quarterlySalesConfig);
            quarterlySales.render();
        }
        // Order Received Area Chart
        // --------------------------------------------------------------------
        const orderReceivedEl = document.querySelector('#orderReceived'),
            orderReceivedConfig = {
                chart: {
                    height: 90,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.warning],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.1
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [350, 500, 310, 460, 280, 400, 300]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof orderReceivedEl !== undefined && orderReceivedEl !== null) {
            const orderReceived = new ApexCharts(orderReceivedEl, orderReceivedConfig);
            orderReceived.render();
        }

        // Revenue Generated Area Chart
        // --------------------------------------------------------------------
        const revenueGeneratedEl = document.querySelector('#revenueGenerated'),
            revenueGeneratedConfig = {
                chart: {
                    height: 90,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.success],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.1
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [300, 350, 330, 380, 340, 400, 380]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof revenueGeneratedEl !== undefined && revenueGeneratedEl !== null) {
            const revenueGenerated = new ApexCharts(revenueGeneratedEl, revenueGeneratedConfig);
            revenueGenerated.render();
        }

        // Expenses Radial Bar Chart
        // --------------------------------------------------------------------
        const expensesRadialChartEl = document.querySelector('#expensesChart'),
            expensesRadialChartConfig = {
                chart: {
                    height: 145,
                    sparkline: {
                        enabled: true
                    },
                    parentHeightOffset: 0,
                    type: 'radialBar'
                },
                colors: [config.colors.warning],
                series: [78],
                plotOptions: {
                    radialBar: {
                        offsetY: 0,
                        startAngle: -90,
                        endAngle: 90,
                        hollow: {
                            size: '65%'
                        },
                        track: {
                            strokeWidth: '45%',
                            background: borderColor
                        },
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                fontSize: '22px',
                                color: headingColor,
                                fontWeight: 500,
                                offsetY: -5
                            }
                        }
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        bottom: 5
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Progress'],
                responsive: [{
                        breakpoint: 1442,
                        options: {
                            chart: {
                                height: 100
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '55%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '16px',
                                            offsetY: -1
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            chart: {
                                height: 228
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '75%'
                                    },
                                    track: {
                                        strokeWidth: '50%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '26px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 890,
                        options: {
                            chart: {
                                height: 180
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 426,
                        options: {
                            chart: {
                                height: 142
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '22px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 376,
                        options: {
                            chart: {
                                height: 105
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '60%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '18px'
                                        }
                                    }
                                }
                            }
                        }
                    }
                ]
            };
        if (typeof expensesRadialChartEl !== undefined && expensesRadialChartEl !== null) {
            const expensesRadialChart = new ApexCharts(expensesRadialChartEl, expensesRadialChartConfig);
            expensesRadialChart.render();
        }

        // Expenses Radial Bar Chart
        // --------------------------------------------------------------------
        const expensesRadialChartEl2 = document.querySelector('#expensesChart2'),
            expensesRadialChartConfig2 = {
                chart: {
                    height: 145,
                    sparkline: {
                        enabled: true
                    },
                    parentHeightOffset: 0,
                    type: 'radialBar'
                },
                colors: [config.colors.warning],
                series: [78],
                plotOptions: {
                    radialBar: {
                        offsetY: 0,
                        startAngle: -90,
                        endAngle: 90,
                        hollow: {
                            size: '65%'
                        },
                        track: {
                            strokeWidth: '45%',
                            background: borderColor
                        },
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                fontSize: '22px',
                                color: headingColor,
                                fontWeight: 500,
                                offsetY: -5
                            }
                        }
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        bottom: 5
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Progress'],
                responsive: [{
                        breakpoint: 1442,
                        options: {
                            chart: {
                                height: 100
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '55%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '16px',
                                            offsetY: -1
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            chart: {
                                height: 228
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '75%'
                                    },
                                    track: {
                                        strokeWidth: '50%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '26px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 890,
                        options: {
                            chart: {
                                height: 180
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 426,
                        options: {
                            chart: {
                                height: 142
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '22px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 376,
                        options: {
                            chart: {
                                height: 105
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '60%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '18px'
                                        }
                                    }
                                }
                            }
                        }
                    }
                ]
            };
        if (typeof expensesRadialChartEl2 !== undefined && expensesRadialChartEl2 !== null) {
            const expensesRadialChart2 = new ApexCharts(expensesRadialChartEl2, expensesRadialChartConfig2);
            expensesRadialChart2.render();
        }


        // Expenses Radial Bar Chart
        // --------------------------------------------------------------------
        const expensesRadialChartEl3 = document.querySelector('#expensesChart3'),
            expensesRadialChartConfig3 = {
                chart: {
                    height: 145,
                    sparkline: {
                        enabled: true
                    },
                    parentHeightOffset: 0,
                    type: 'radialBar'
                },
                colors: [config.colors.warning],
                series: [78],
                plotOptions: {
                    radialBar: {
                        offsetY: 0,
                        startAngle: -90,
                        endAngle: 90,
                        hollow: {
                            size: '65%'
                        },
                        track: {
                            strokeWidth: '45%',
                            background: borderColor
                        },
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                fontSize: '22px',
                                color: headingColor,
                                fontWeight: 500,
                                offsetY: -5
                            }
                        }
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        bottom: 5
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Progress'],
                responsive: [{
                        breakpoint: 1442,
                        options: {
                            chart: {
                                height: 100
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '55%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '16px',
                                            offsetY: -1
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            chart: {
                                height: 228
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '75%'
                                    },
                                    track: {
                                        strokeWidth: '50%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '26px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 890,
                        options: {
                            chart: {
                                height: 180
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 426,
                        options: {
                            chart: {
                                height: 142
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '70%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '22px'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 376,
                        options: {
                            chart: {
                                height: 105
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: '60%'
                                    },
                                    dataLabels: {
                                        value: {
                                            fontSize: '18px'
                                        }
                                    }
                                }
                            }
                        }
                    }
                ]
            };
        if (typeof expensesRadialChartEl3 !== undefined && expensesRadialChartEl3 !== null) {
            const expensesRadialChart3 = new ApexCharts(expensesRadialChartEl3, expensesRadialChartConfig3);
            expensesRadialChart3.render();
        }

        // Orders last week Bar Chart
        // --------------------------------------------------------------------
        const ordersLastWeekEl = document.querySelector('#ordersLastWeek'),
            ordersLastWeekConfig = {
                chart: {
                    height: 90,
                    parentHeightOffset: 0,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                tooltip: {
                    enabled: false
                },
                plotOptions: {
                    bar: {
                        barHeight: '100%',
                        columnWidth: '30px',
                        startingShape: 'rounded',
                        endingShape: 'rounded',
                        borderRadius: 4,
                        colors: {
                            backgroundBarColors: [barBgColor, barBgColor, barBgColor, barBgColor, barBgColor,
                                barBgColor, barBgColor
                            ],
                            backgroundBarRadius: 4
                        }
                    }
                },
                colors: [config.colors.primary],
                grid: {
                    show: false,
                    padding: {
                        top: -30,
                        left: -16,
                        bottom: 0,
                        right: -6
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    data: [60, 50, 20, 45, 50, 30, 70]
                }],
                legend: {
                    show: false
                },
                xaxis: {
                    categories: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                responsive: [{
                        breakpoint: 1441,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: '40%',
                                    borderRadius: 4
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1368,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: '48%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 6,
                                    columnWidth: '30%',
                                    colors: {
                                        backgroundBarRadius: 6
                                    }
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 991,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: '35%',
                                    borderRadius: 6
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 883,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: '40%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 768,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: '25%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 576,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 9
                                },
                                colors: {
                                    backgroundBarRadius: 9
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 479,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: '35%'
                                },
                                colors: {
                                    backgroundBarRadius: 4
                                }
                            },
                            grid: {
                                padding: {
                                    right: -15,
                                    left: -15
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 376,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 3
                                }
                            }
                        }
                    }
                ]
            };
        if (typeof ordersLastWeekEl !== undefined && ordersLastWeekEl !== null) {
            const ordersLastWeek = new ApexCharts(ordersLastWeekEl, ordersLastWeekConfig);
            ordersLastWeek.render();
        }

        // Sales last year Area Chart
        // --------------------------------------------------------------------
        const salesLastYearEl = document.querySelector('#salesLastYear'),
            salesLastYearConfig = {
                chart: {
                    height: 90,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                markers: {
                    colors: 'transparent',
                    strokeColors: 'transparent'
                },
                grid: {
                    show: false
                },
                colors: [config.colors.success],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.8,
                        opacityFrom: 0.6,
                        opacityTo: 0.25
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    data: [200, 55, 400, 250]
                }],
                xaxis: {
                    show: true,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };
        if (typeof salesLastYearEl !== undefined && salesLastYearEl !== null) {
            const salesLastYear = new ApexCharts(salesLastYearEl, salesLastYearConfig);
            salesLastYear.render();
        }

        // Profit last month Line Chart
        // --------------------------------------------------------------------
        const profitLastMonthEl = document.querySelector('#profitLastMonth'),
            profitLastMonthConfig = {
                chart: {
                    height: 90,
                    type: 'line',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    }
                },
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 6,
                    xaxis: {
                        lines: {
                            show: true,
                            colors: '#000'
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                    padding: {
                        top: -18,
                        left: -4,
                        right: 7,
                        bottom: -10
                    }
                },
                colors: [config.colors.info],
                stroke: {
                    width: 2
                },
                series: [{
                    data: [0, 25, 10, 40, 25, 55]
                }],
                tooltip: {
                    shared: false,
                    intersect: true,
                    x: {
                        show: false
                    }
                },
                xaxis: {
                    labels: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                tooltip: {
                    enabled: false
                },
                markers: {
                    size: 3.5,
                    fillColor: config.colors.info,
                    strokeColors: 'transparent',
                    strokeWidth: 3.2,
                    discrete: [{
                        seriesIndex: 0,
                        dataPointIndex: 5,
                        fillColor: cardColor,
                        strokeColor: config.colors.info,
                        size: 5,
                        shape: 'circle'
                    }],
                    hover: {
                        size: 5.5
                    }
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 110
                        }
                    }
                }]
            };
        if (typeof profitLastMonthEl !== undefined && profitLastMonthEl !== null) {
            const profitLastMonth = new ApexCharts(profitLastMonthEl, profitLastMonthConfig);
            profitLastMonth.render();
        }

    })();
</script>
