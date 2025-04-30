$(function () {
    var chartOptions = {
      series: [{
        name: "banyak pengunjung",
        data: [355, 390, 300, 350, 390, 180, 355, 390]
      }],
      chart: {
        type: "area",
        height: 345,
        toolbar: { show: false },
        foreColor: "#adb0bb",
        fontFamily: "inherit",

      },
      colors: ["#5D87FF"],
      dataLabels: { enabled: false },
      stroke: {
        curve: "straight",
        width: 3,
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: 'light',
          type: 'vertical',
          shadeIntensity: 0.5,
          opacityFrom: 0.7,
          opacityTo: 0.1,
          stops: [0, 100],
        },
      },
      markers: {
        size: 5,
        colors: ["#5D87FF"],
        strokeWidth: 2,
        strokeColors: "#ffffff",
        hover: {
          size: 7
        }
      },
      grid: {
        borderColor: "rgba(0,0,0,0.1)",
        strokeDashArray: 3,
      },
      xaxis: {
        type: "category",
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"], // Bulan
        labels: {
          style: { cssClass: "grey--text lighten-2--text fill-color" },
        },
      },
      yaxis: {
        tickAmount: 4,
        labels: {
          style: {
            cssClass: "grey--text lighten-2--text fill-color",
          },
        },
      },
      tooltip: { theme: "light" },
    };


    var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
    chart.render();

    function updateChartData(type) {
      if (type === "line_1") {
        chart.updateSeries([{
          name: "banyak pengunjung",
          data: [355, 390, 300, 350, 390, 180, 355, 390]
        }]);
      } else if (type === "line_2") {
        chart.updateSeries([{
          name: "Entah",
          data: [280, 250, 325, 215, 250, 310, 280, 250]
        }]);
      }
    }

    updateChartData("line_1");

    document.querySelector("#dataSelector").addEventListener("change", function () {
      updateChartData(this.value);5
    });
  });
