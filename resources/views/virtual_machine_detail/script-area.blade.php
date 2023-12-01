<script>
    /**
 * Charts Apex
 */

'use strict';

$(document).ready(function() {
    $(".filter-date").on('click', function(e) {
      e.preventDefault(); // cancel the link behaviour
      var selText = $(this).text();
      $(".text-date").text(selText);
      console.log(selText)
    });
});

(function () {
  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = '#4B465C';
    headingColor = '#4B465C';
    labelColor = '#4B465C';
    legendColor = '#4B465C';
    borderColor = '#4B465C';
  } else {
    cardColor = '#4B465C';
    headingColor = '#4B465C';
    labelColor = '#4B465C';
    legendColor = '#4B465C';
    borderColor = '#DBDADE';
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
      series4: '#2b9bf4'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };


  // Line Area Chart
  // --------------------------------------------------------------------
  const areaChartEl = document.querySelector('#networkGraph'),
    areaChartConfig = {
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
          colors: legendColor,
          useSeriesColors: false
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      colors: ['#60F2CA', '#A4F8CD', '#A4F8CD'],
      series: [
        {
          name: 'Upload',
          data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375]
        },
        {
          name: 'Download',
          data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
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
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
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

    const areaChart = new ApexCharts(areaChartEl, areaChartConfig);
    areaChart.render();

    // Line Area Chart
  // --------------------------------------------------------------------
  const areaChartEl2 = document.querySelector('#diskGraph'),
    areaChartConfig2 = {
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
          colors: legendColor,
          useSeriesColors: false
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      colors: ['#60F2CA', '#A4F8CD', '#A4F8CD'],
      series: [
        {
          name: 'Write',
          data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375]
        },
        {
          name: 'Read',
          data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
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
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
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

    const areaChart2 = new ApexCharts(areaChartEl2, areaChartConfig2);
    areaChart2.render();
})();

</script>
