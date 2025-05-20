$(function () {
    const defaultYear = Object.keys(chartData)[0];

    const chartOptions = {
        series: [
            {
                name: "Jumlah Pemeriksaan",
                data: chartData[defaultYear].data,
            },
        ],
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
                shade: "light",
                type: "vertical",
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
            hover: { size: 7 },
        },
        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
        },
        xaxis: {
            type: "category",
            categories: chartData[defaultYear].labels,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                    fontSize: "14px",
                },
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

    const chart = new ApexCharts(
        document.querySelector("#chart"),
        chartOptions
    );
    chart.render();

    document
        .querySelector("#yearSelector")
        .addEventListener("change", function () {
            const selectedYear = this.value;
            chart.updateSeries([
                {
                    name: "Jumlah Pemeriksaan",
                    data: chartData[selectedYear].data,
                },
            ]);
            chart.updateOptions({
                xaxis: { categories: chartData[selectedYear].labels },
            });
        });
});
