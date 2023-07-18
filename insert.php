
<?php
include 'config.php';
?>

<?php
session_start();
// initializing variables
$username = "";
$errors = array();
// connect to the database
// REGISTER USER
if (isset($_POST['submit'])) {
// receive all input values from the form
    $studentnumber = mysqli_real_escape_string($db_conn, $_POST['studentnumber']);
    $fullname = mysqli_real_escape_string($db_conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($db_conn, $_POST['email']);
    $faculty = mysqli_real_escape_string($db_conn, $_POST['faculty']);
    $course = mysqli_real_escape_string($db_conn, $_POST['course']);
    $dob = mysqli_real_escape_string($db_conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($db_conn, $_POST['gender']);
// first check the database to make sure
// a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($db_conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
// if user exists
if(isset($user['email']) == $email) {

echo "<script>alert('The student already exist!')</script>";

header('Location: index.php');
exit();
}
// Finally, register user if there are no errors in the form
if (count($errors) == 0) {
// $passwordd = md5($password);//encrypt the password before saving in the database

// if ($password == $password1) {
// }
$query = "INSERT INTO students (stdNumber,fullname, email, faculty, course, dob, gender)
VALUES(CONCAT('SN', LPAD((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'students'), 7, '0')),'$fullname', '$email', '$faculty', '$course', '$dob', '$gender')";

mysqli_query($db_conn, $query);


// else {
// echo "<script>alert('Password not matching!')</script>";
// }
}
header('location: index.php');
}
?>
