<?php
include 'config.php';
?>

<?php
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  
  // Fetch user details based on the received ID
  $sql = "SELECT * FROM students WHERE id = $id";
  $result = mysqli_query($db_conn, $sql);
  $user = mysqli_fetch_object($result);
     
  // Display the user details
  echo '<p><strong>Student ID</strong>: ' . $user->stdNumber . '</p>';
  echo '<p><strong>Full Name</strong>: ' . $user->fullName . '</p>';
  echo '<p><strong>Email</strong>: ' . $user->email . '</p>';
  echo '<p><strong>Faculty</strong>: ' . $user->faculty . '</p>';
  echo '<p><strong>Course</strong>: ' . $user->course . '</p>';
  echo '<p><strong>Date of Birth</strong>: ' . $user->dob . '</p>';
  echo '<p><strong>Gender</strong>: ' . $user->gender . '</p>';
} else {
  echo 'Invalid request';
}
?>
