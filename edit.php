<?php
include 'config.php';

// Course data by faculty
$editcoursesByFaculty = [
    'science' => ["DIPLOMA IN AGRICULTURE (ECP)", "DIPLOMA IN BIOTECHNOLOGY", "ND: ANALYTICAL CHEMISTRY (EXTENDED)"],
    'business' => ["DIPLOMA IN BUSINESS & INFORMATION ADMINISTRATION", "ND: HOSPITALITY MANAGEMENT: ACCOMMODATION"],
    'education' => ["DIPLOMA IN GRADE R TEACHING", "B.ED HONORS IN EDUCATIONAL MANAGEMENT & LEADERSHIP", "B.ED IN SENIOR PHASE AND FET TEACHING", "POST GRADUATE CERTIFICATE IN EDUCATION: FET"],
    'engineering' => ["BACHELOR OF ENGINEERING TECHNOLOGY IN CHEMICAL ENGINEERING", "BACHELOR OF ENGINEERING TECHNOLOGY IN CIVIL ENGINEERING", "BACHELOR OF ENGINEERING TECHNOLOGY IN COMPUTER ENGINEERING"],
    'health' => ["BACHELOR OF HEALTH SCIENCE IN MEDICAL LABORATORY SCIENCE", "BACHELOR OF HEALTH SCIENCE IN MEDICAL LAB SCIENCE"],
    'design' => ["DIPLOMA IN ARCHITECTURAL TECHNOLOGY (ECP)", "ND: ARCHITECTURAL TECHNOLOGY", "ADVANCED DIPLOMA IN FASHION", "DIPLOMA IN FILM PRODUCTION"]
];

// Function to update the course dropdown options based on the selected faculty
function updateCourses() {
    echo '<script>';
    echo 'const editfacultySelect = document.getElementById("editFaculty");';
    echo 'const editcourseSelect = document.getElementById("editCourse");';
    echo 'const editselectedFaculty = editfacultySelect.value;';

    echo 'editcourseSelect.innerHTML = "";';

    echo 'const editcoursesByFaculty = ' . json_encode($GLOBALS['editcoursesByFaculty']) . ';';
    echo 'editcoursesByFaculty[editselectedFaculty].forEach(editCourse => {';
    echo 'const option = document.createElement("option");';
    echo 'option.text = editCourse;';
    echo 'editcourseSelect.add(option);';
    echo '});';
    echo '</script>';
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
  
    // Fetch user details based on the received ID
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($db_conn, $sql);
    $user = mysqli_fetch_object($result);

    echo '<h2>Edit User Details</h2>';
    echo '<form action="update_user.php" method="post">';
    echo '<label for="studentnumber1">Student Number:</label>';
    echo '<input type="text" name="studentnumber1" value="' . $user->stdNumber . '" readonly>';
    echo '<label for="fullName">Full Name:</label>';
    echo '<input type="text" id="fullName" name="fullName" value="' . $user->fullName . '" required>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" value="' . $user->email . '" required>';
    echo '<label for="editFaculty">Faculty:</label>';
    echo '<select id="editFaculty" name="editFaculty" onchange="updateCourses()">';
    echo '<option value="science" ' . ($user->faculty === 'science' ? 'selected' : '') . '>Science</option>';
    echo '<option value="business" ' . ($user->faculty === 'business' ? 'selected' : '') . '>Business</option>';
    echo '<option value="education" ' . ($user->faculty === 'education' ? 'selected' : '') . '>Education</option>';
    echo '<option value="engineering" ' . ($user->faculty === 'engineering' ? 'selected' : '') . '>Engineering</option>';
    echo '<option value="health" ' . ($user->faculty === 'health' ? 'selected' : '') . '>Health</option>';
    echo '<option value="design" ' . ($user->faculty === 'design' ? 'selected' : '') . '>Design</option>';
    echo '</select>';
    echo '<label for="editCourse">Course:</label>';
    echo '<select id="editCourse" name="editCourse">';
    echo '</select>';
    echo '<label for="dob">Date of Birth:</label>';
    echo '<input type="date" id="dob" name="dob" value="' . $user->dob . '" required>';
    echo '<label for="gender">Gender:</label>';
    echo '<select id="gender" name="gender">';
    echo '<option value="Male" ' . ($user->gender === 'Male' ? 'selected' : '') . '>Male</option>';
    echo '<option value="Female" ' . ($user->gender === 'Female' ? 'selected' : '') . '>Female</option>';
    // Add more options as needed
    echo '</select>';
    echo '<input type="submit" value="Update">';
    echo '</form>';
} else {
    // If the user is not found, display an error message or handle it appropriately
    echo '<p>User not found.</p>';
}

// Call the updateCourses function initially to populate the course dropdown based on the selected faculty
echo '<script>updateCourses();</script>';
?>
