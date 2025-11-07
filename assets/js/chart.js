fetch('configs/get_report_data.php')
    .then(response => response.json())
    .then(data => {
        var options = {
            chart: {
                type: 'pie'
            },
            series: [data.sent, data.process, data.responded],
            labels: ['Sent', 'Process', 'Responded'],
            colors: ['#FF5733', '#FFC300', '#28B463'],
            legend: {
                position: 'bottom'
            },
            title: {
                text: 'Status Pengaduan'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-visitors-profile"), options);
        chart.render();
    });