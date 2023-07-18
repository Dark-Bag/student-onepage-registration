<?php
include 'config.php';
?>
<?php
// Assuming you have already established a valid database connection with $db_conn

$sql = "SELECT faculty,course, COUNT(*) AS student_count FROM students GROUP BY faculty,course";
$result = mysqli_query($db_conn, $sql);

$chartData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $chartData[] = $row;
}

// Convert the data to JSON format
$jsonData = json_encode($chartData);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonData;
?>
