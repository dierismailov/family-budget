<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(
                <?php echo json_encode($chartData) ?>
            );

            var options = {
                title: 'Monthly Expense/Income throughout the year By Family',
                vAxis: {title: 'Sum'},
                hAxis: {title: 'Month'},
                seriesType: 'bars',
                series: {1: {type: 'line'}},
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>
