$(function () {
    const defaultYear = Object.keys(chartData)[0];

    function Bulan(labels) {
        return labels.map((item, index) => {
            let monthIndex;

            if (typeof item === 'number') {
                monthIndex = item - 1;
            } else if (typeof item === 'string') {
                const date = new Date(`${item} 1, 2000`);
                if (!isNaN(date)) {
                    monthIndex = date.getMonth();
                } else {
                    monthIndex = index;
                }
            } else {
                monthIndex = index;
            }

            const dateObj = new Date(2000, monthIndex);
            return dateObj.toLocaleString('id-ID', { month: 'long' });
        });
    }

    const fallbackLabels = Array.from({ length: 12 }, (_, i) =>
        new Date(2000, i).toLocaleString('id-ID', { month: 'long' })
    );

    const defaultData = chartData[defaultYear]?.data?.length
        ? chartData[defaultYear].data
        : new Array(12).fill(0);

    const defaultLabels = chartData[defaultYear]?.labels?.length
        ? Bulan(chartData[defaultYear].labels)
        : fallbackLabels;

    const chartOptions = {
        series: [
            {
                name: "Jumlah Pemeriksaan",
                data: defaultData,
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
            categories: defaultLabels,
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

    const chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
    chart.render();

    document.querySelector("#yearSelector").addEventListener("change", function () {
        const selectedYear = this.value;

        const yearData = chartData[selectedYear]?.data?.length
            ? chartData[selectedYear].data
            : new Array(12).fill(0);

        const yearLabels = chartData[selectedYear]?.labels?.length
            ? Bulan(chartData[selectedYear].labels)
            : fallbackLabels;

        chart.updateSeries([
            {
                name: "Jumlah Pemeriksaan",
                data: yearData,
            },
        ]);

        chart.updateOptions({
            xaxis: { categories: yearLabels },
        });
    });
});
