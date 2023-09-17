$(function () {
    //-------------
    //- BAR CHART -
    //-------------
    var areaChartData = {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
        ],
        datasets: [
            {
                label: "Pemasukan",
                backgroundColor: "rgba(40,167,69,0.9)",
                borderColor: "rgba(40,167,69,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(40,167,69,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(40,167,69,1)",
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                label: "Pengeluaran",
                backgroundColor: "rgba(220,53,69,0.9)",
                borderColor: "rgba(220,53,69,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(220,53,69,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,53,69,1)",
                data: [32, 61, 12, 39, 6, 62, 21],
            },
        ],
    };

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    var barChartCanvas = $("#barChartGanjil").text("tesdoang");
    var barChartData = $.extend(true, {}, areaChartData);
    for (let i = 0; i < areaChartData.datasets.length; i++) {
        let temp = areaChartData.datasets[i];
        barChartData.datasets[i] = temp;
    }

    new Chart(barChartCanvas, {
        type: "bar",
        data: barChartData,
        options: barChartOptions,
    });

    var barChartCanvas = $("#barChartGenap").text("tesdoang");
    var barChartData = $.extend(true, {}, areaChartData);
    for (let i = 0; i < areaChartData.datasets.length; i++) {
        let temp = areaChartData.datasets[i];
        barChartData.datasets[i] = temp;
    }

    new Chart(barChartCanvas, {
        type: "bar",
        data: barChartData,
        options: barChartOptions,
    });
});
