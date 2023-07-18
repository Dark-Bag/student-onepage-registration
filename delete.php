<?php include("config.php") ?>
<?php
global $db_conn;
if (isset($_POST['id'])) {
$id = $_POST['id'];
$record = mysqli_query($db_conn, "DELETE FROM students WHERE
id=$id");
echo json_encode(['success' => true]);
} else {
  // Return an error response
  echo json_encode(['success' => false, 'message' => 'Invalid request']);
header('location: index.php');
}
?>