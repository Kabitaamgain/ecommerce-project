<?php
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());

if($_SESSION['mpid'] != 1) {
    header("location: http://localhost/ToleSudharSamiti/Members/index.php");
    exit();
}
// Database connection (Ensure that $conn is properly set up beforehand)
$sql = "SELECT created_at, payment, SUM(price) as price FROM orders WHERE id <> '1' GROUP BY created_at, payment";
$result = mysqli_query($conn, $sql);

$loanData = array();

while($rows = mysqli_fetch_assoc($result)) {
    $timestamp = date("Y-m-d", strtotime($rows['loandate']));
    $loanData[$timestamp][$rows['loan_status']] = (float) $rows['total_amount'];
}

$dataRows = array();
$dataRows[] = array('Date', 'Approved', 'Pending', 'Clear');

foreach ($loanData as $date => $statuses) {
    $approved = isset($statuses['approve']) ? $statuses['approve'] : 0;
    $pending = isset($statuses['pending']) ? $statuses['pending'] : 0;
    $clear = isset($statuses['clear']) ? $statuses['clear'] : 0;

    $dataRows[] = array($date, $approved, $pending, $clear);
}

?>

    <script type="text/javascript">
        google.charts.load('current', {'packages'🙁'corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($dataRows); ?>);

            var options = {
                title: 'Loan Amount Vs Loan Date',
                hAxis: {title: 'Date'},
                vAxis: {title: 'Loan Amount (Rs)'},
                seriesType: 'area',
                series: {
                    0: { color: '#3366CC' },  // Change color if needed
                    1: { color: '#DC3912' }   // Change color if needed
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chartContainer'));
            chart.draw(data, options);
        }
    </script>