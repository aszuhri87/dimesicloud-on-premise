<script>


// 'use strict';

// (function () {
  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

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
      series4: '#2b9bf4',
      series5: '#e9ecef'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };

  const rawChart = (raw, used, avail) => {
        rawChartConfig = {
          chart: {
            height: 390,
            type: 'donut'
          },
          labels: ['Used', 'Available'],
          series: [used, avail],
          colors: [
            chartColors.donut.series1,
            chartColors.donut.series5,
          ],
          stroke: {
            show: false,
            curve: 'straight'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return parseInt(val, 10) + '%';
            }
          },
          legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            itemMargin: {
              vertical: 3,
              horizontal: 10
            },
            labels: {
              colors: legendColor,
              useSeriesColors: false
            }
          },
          plotOptions: {
            pie: {
              donut: {
                labels: {
                  show: true,
                  name: {
                    fontSize: '2rem',
                    fontFamily: 'Public Sans'
                  },
                  value: {
                    fontSize: '1.2rem',
                    color: legendColor,
                    fontFamily: 'Public Sans',
                    formatter: function (val) {
                      return parseInt(val, 10) + 'GB';
                    }
                  },
                  total: {
                    show: true,
                    fontSize: '1.5rem',
                    color: headingColor,
                    label: raw,
                    formatter: function (w) {
                      return ' GB';
                    }
                  }
                }
              }
            }
          },
          responsive: [
            {
              breakpoint: 992,
              options: {
                chart: {
                  height: 380
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 576,
              options: {
                chart: {
                  height: 320
                },
                plotOptions: {
                  pie: {
                    donut: {
                      labels: {
                        show: true,
                        name: {
                          fontSize: '1.5rem'
                        },
                        value: {
                          fontSize: '1rem'
                        },
                        total: {
                          fontSize: '1.5rem'
                        }
                      }
                    }
                  }
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 420,
              options: {
                chart: {
                  height: 280
                },
                legend: {
                  show: false
                }
              }
            },
            {
              breakpoint: 360,
              options: {
                chart: {
                  height: 250
                },
                legend: {
                  show: false
                }
              }
            }
          ]
        };
        var chart = new ApexCharts(document.querySelector("#rawChart"), rawChartConfig);
        chart.render();

        chart.updateSeries([used, avail])
        // chart.updateOptions({
        //     labels: [category]
        // })
  }

  const objectChart = (data) => {
    //   const objectChartEl = document.querySelector('#objectChart'),
        objectChartConfig = {
          chart: {
            height: 390,
            type: 'donut'
          },
          labels: ['Healthy', 'Misplaced', 'Degraded', 'Unfound'],
          series: [data, 0, 0, 0],
          colors: [
            chartColors.donut.series1,
            chartColors.donut.series4,
            chartColors.donut.series3,
            chartColors.donut.series5
          ],
          stroke: {
            show: false,
            curve: 'straight'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return parseInt(val, 10) + '%';
            }
          },
          legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            itemMargin: {
              vertical: 3,
              horizontal: 10
            },
            labels: {
              colors: legendColor,
              useSeriesColors: false
            }
          },
          plotOptions: {
            pie: {
              donut: {
                labels: {
                  show: true,
                  name: {
                    fontSize: '2rem',
                    fontFamily: 'Public Sans'
                  },
                  value: {
                    fontSize: '1.2rem',
                    color: legendColor,
                    fontFamily: 'Public Sans',
                    formatter: function (val) {
                      return val;
                    }
                  },
                  total: {
                    show: true,
                    fontSize: '1.5rem',
                    color: headingColor,
                    // label: data,
                    // formatter: function (w) {
                    //   return '42%';
                    // }
                  }
                }
              }
            }
          },
          responsive: [
            {
              breakpoint: 992,
              options: {
                chart: {
                  height: 380
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 576,
              options: {
                chart: {
                  height: 320
                },
                plotOptions: {
                  pie: {
                    donut: {
                      labels: {
                        show: true,
                        name: {
                          fontSize: '1.5rem'
                        },
                        value: {
                          fontSize: '1rem'
                        },
                        total: {
                          fontSize: '1.5rem'
                        }
                      }
                    }
                  }
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 420,
              options: {
                chart: {
                  height: 280
                },
                legend: {
                  show: false
                }
              }
            },
            {
              breakpoint: 360,
              options: {
                chart: {
                  height: 250
                },
                legend: {
                  show: false
                }
              }
            }
          ]
        };
        var chart = new ApexCharts(document.querySelector("#objectChart"), objectChartConfig);
        chart.render();

        chart.updateSeries([data, 0,0,0])
  }

  const pgChart = (category, count) => {
        pgChartConfig = {
          chart: {
            height: 390,
            type: 'donut'
          },
          labels: [''],
          series: count,
          colors: [
            chartColors.donut.series1,
            chartColors.donut.series4,
            chartColors.donut.series3,
            chartColors.donut.series5
          ],
          stroke: {
            show: false,
            curve: 'straight'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return parseInt(val, 10) + '%';
            }
          },
          legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            itemMargin: {
              vertical: 3,
              horizontal: 10
            },
            labels: {
              colors: legendColor,
              useSeriesColors: false
            }
          },
          plotOptions: {
            pie: {
              donut: {
                labels: {
                  show: true,
                  name: {
                    fontSize: '2rem',
                    fontFamily: 'Public Sans'
                  },
                  value: {
                    fontSize: '1.2rem',
                    color: legendColor,
                    fontFamily: 'Public Sans',
                    formatter: function (val) {
                      return parseInt(val, 10) + '%';
                    }
                  },
                  total: {
                    show: true,
                    fontSize: '1.5rem',
                    color: headingColor,
                    label: count,
                    formatter: function (w) {
                      return 'PGs';
                    }
                  }
                }
              }
            }
          },
          responsive: [
            {
              breakpoint: 992,
              options: {
                chart: {
                  height: 380
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 576,
              options: {
                chart: {
                  height: 320
                },
                plotOptions: {
                  pie: {
                    donut: {
                      labels: {
                        show: true,
                        name: {
                          fontSize: '1.5rem'
                        },
                        value: {
                          fontSize: '1rem'
                        },
                        total: {
                          fontSize: '1.5rem'
                        }
                      }
                    }
                  }
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 420,
              options: {
                chart: {
                  height: 280
                },
                legend: {
                  show: false
                }
              }
            },
            {
              breakpoint: 360,
              options: {
                chart: {
                  height: 250
                },
                legend: {
                  show: false
                }
              }
            }
          ]
        };

    var chart = new ApexCharts(document.querySelector("#pgChart"), pgChartConfig);
        chart.render();

    chart.updateSeries(count)
    chart.updateOptions({
        labels: [category, 'Working', 'Warning', 'Unknown']
    })
  }

  const clientRwChart = (data) => {
      const clientRwChartEl = document.querySelector('#clientRwChart'),
        clientRwChartConfig = {
          chart: {
            height: 390,
            type: 'donut'
          },
          labels: ['Used', 'Available'],
          series: [0, 0],
          colors: [
            chartColors.donut.series1,
            chartColors.donut.series4,
          ],
          stroke: {
            show: false,
            curve: 'straight'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return parseInt(val, 10) + '%';
            }
          },
          legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            itemMargin: {
              vertical: 3,
              horizontal: 10
            },
            labels: {
              colors: legendColor,
              useSeriesColors: false
            }
          },
          plotOptions: {
            pie: {
              donut: {
                labels: {
                  show: true,
                  name: {
                    fontSize: '2rem',
                    fontFamily: 'Public Sans'
                  },
                  value: {
                    fontSize: '1.2rem',
                    color: legendColor,
                    fontFamily: 'Public Sans',
                    formatter: function (val) {
                      return parseInt(val, 10) + '%';
                    }
                  },
                  total: {
                    show: true,
                    fontSize: '1.5rem',
                    color: headingColor,
                    label: 'Operational',
                    formatter: function (w) {
                      return '42%';
                    }
                  }
                }
              }
            }
          },
          responsive: [
            {
              breakpoint: 992,
              options: {
                chart: {
                  height: 380
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 576,
              options: {
                chart: {
                  height: 320
                },
                plotOptions: {
                  pie: {
                    donut: {
                      labels: {
                        show: true,
                        name: {
                          fontSize: '1.5rem'
                        },
                        value: {
                          fontSize: '1rem'
                        },
                        total: {
                          fontSize: '1.5rem'
                        }
                      }
                    }
                  }
                },
                legend: {
                  position: 'bottom',
                  labels: {
                    colors: legendColor,
                    useSeriesColors: false
                  }
                }
              }
            },
            {
              breakpoint: 420,
              options: {
                chart: {
                  height: 280
                },
                legend: {
                  show: false
                }
              }
            },
            {
              breakpoint: 360,
              options: {
                chart: {
                  height: 250
                },
                legend: {
                  show: false
                }
              }
            }
          ]
        };
      if (typeof clientRwChartEl !== undefined && clientRwChartEl !== null) {
        const clientRwChart = new ApexCharts(clientRwChartEl, clientRwChartConfig);
        clientRwChart.render();
      }
  }


    // --------------------------------------------------------------------
    const clientThroughputChart = (data) => {
      const clientThroughputChartEl = document.querySelector('#clientThroughputChart'),
      clientThroughputChartConfig = {
        chart: {
          height: 390,
          type: 'donut'
        },
        labels: ['Read: 889', 'Write:999'],
        series: [0, 0],
        colors: [
          chartColors.donut.series1,
          chartColors.donut.series4,
        ],
        stroke: {
          show: false,
          curve: 'straight'
        },
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            return parseInt(val, 10) + '%';
          }
        },
        legend: {
          show: true,
          position: 'bottom',
          markers: { offsetX: -3 },
          itemMargin: {
            vertical: 3,
            horizontal: 10
          },
          labels: {
            colors: legendColor,
            useSeriesColors: false
          }
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                name: {
                  fontSize: '2rem',
                  fontFamily: 'Public Sans'
                },
                value: {
                  fontSize: '1.2rem',
                  color: legendColor,
                  fontFamily: 'Public Sans',
                  formatter: function (val) {
                    return parseInt(val, 10) + '%';
                  }
                },
                total: {
                  show: true,
                  fontSize: '1.5rem',
                  color: headingColor,
                  label: 'Operational',
                  formatter: function (w) {
                    return '42%';
                  }
                }
              }
            }
          }
        },
        responsive: [
          {
            breakpoint: 992,
            options: {
              chart: {
                height: 380
              },
              legend: {
                position: 'bottom',
                labels: {
                  colors: legendColor,
                  useSeriesColors: false
                }
              }
            }
          },
          {
            breakpoint: 576,
            options: {
              chart: {
                height: 320
              },
              plotOptions: {
                pie: {
                  donut: {
                    labels: {
                      show: true,
                      name: {
                        fontSize: '1.5rem'
                      },
                      value: {
                        fontSize: '1rem'
                      },
                      total: {
                        fontSize: '1.5rem'
                      }
                    }
                  }
                }
              },
              legend: {
                position: 'bottom',
                labels: {
                  colors: legendColor,
                  useSeriesColors: false
                }
              }
            }
          },
          {
            breakpoint: 420,
            options: {
              chart: {
                height: 280
              },
              legend: {
                show: false
              }
            }
          },
          {
            breakpoint: 360,
            options: {
              chart: {
                height: 250
              },
              legend: {
                show: false
              }
            }
          }
        ]
      };
      if (typeof clientThroughputChartEl !== undefined && clientThroughputChartEl !== null) {
        const clientThroughputChart = new ApexCharts(clientThroughputChartEl, clientThroughputChartConfig);
        clientThroughputChart.render();
      }
    }


    const getData = () => {
        $.ajax({
                url: "{{ url ('ceph/data')}}",
                type: 'GET',
            })
            .done(function(res, xhr, meta) {
                let data = res.data;
                let raw_numb = bytesToSize(data.raw_capacity).replace(" G", "");
                let raw_used = bytesToSize(data.raw_used).replace(" G", "");
                let raw_avail = bytesToSize(data.raw_avail).replace(" G", "");

                pgChart(JSON.parse(data.pg_category), JSON.parse(data.pg_count));
                rawChart(Math.ceil(raw_numb), parseInt(raw_used), Math.ceil(raw_avail));
                objectChart(parseInt(data.num_object));

                $('#health').text(data.health);
                $('#managers_active').text(data.mgr_active_total + ' Active ');
                $('#managers_standby').text(data.mgr_standbys_total + ' Standby')
                $('#osds').text(data.osd_total + ' Total, ' + data.osd_up + ' Up, ' + data.osd_in + ' In' );
                $('#pools').text(data.pg_pools);
                $('#pg_per_osd').text(data.pg_per_osds);
                $('#monitors').text(data.monitors)
            })
            .fail(function(res, error) {

            })
            .always(function() {

            });
    }

    $(document).ready(function() {
        getData();
        setInterval(getData, 15000);

        clientThroughputChart();
        pgChart()
        rawChart()
        objectChart()
        clientRwChart();
    })
</script>
