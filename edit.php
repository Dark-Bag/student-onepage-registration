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
}  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Data</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page-container">

    <div id="overlay" class="overlay">
        <div class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Add Student</h2>
            <form method="post" action="insert.php">

                <div class="form-group studentnumber">
                    <label for="studentnumber">Student Number</label>
                    <input type="text" id="studentnumber" name="studentnumber" placeholder="Enter your student">
                </div>
                <div class="form-group fullname">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name">
                </div>
                <div class="form-group email">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email address">
                </div>
                <div class="form-group faculty">
                    <label for="faculty">Faculty</label>
                    <select id="faculty" name="faculty">
                    <option value="" selected disabled>Select your faculty</option>
                    <option value="science">Applied Sciences </option>
                    <option value="business">Business & Management Sciences</option>
                    <option value="education">Education</option>
                    <option value="engineering">Engineering</option>
                    <option value="health">Health & Wellness Sciences</option>
                    <option value="design">Informatics & Design</option>
                    </select>
                </div>
                <div class="form-group course">
                    <label for="course">Course</label>
                    <select id="course" name="course">
                    <option value="" selected disabled>Select your course</option>
                    </select>
                </div>
              
                <div class="form-group date">
                    <label for="dob">Birth Date</label>
                    <input type="date" id="dob" name="dob" placeholder="Select your date">
                </div>
                <div class="form-group gender">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                    <option value="" selected disabled>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group submit-btn">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
   
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
