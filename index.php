<?php
include 'config.php';
?>
<?php
global $db_conn;
// Initialize the $tr variable
$tr = '';
$sql = "SELECT * FROM students";
$result = mysqli_query($db_conn,$sql);
while($row = mysqli_fetch_object($result))
{
$tr.="<tr>
    <td>$row->stdNumber</td>
    <td>$row->fullName</td>
    <td>$row->email</td>
    <td>$row->course</td>
    <td class='action-column'>
    <div class='action-icons'>
    <a href='' class = 'editButton' title='Edit' data-toggle='modal' data-target='#editModal' data-id='$row->id'><i class='fas fa-pencil'></i></a>
    <a href='' class = 'viewButton' title='View' data-toggle='modal' data-target='#viewModal' data-id='$row->id'><i class='far fa-eye'></i></a>
    <a href='' class = 'deleteButton' title='Delete' data-toggle='modal' data-target='#deleteConfirmationModal' data-id='$row->id'><i class='fas fa-trash'></i></a>
  </div>
</div>
</td>
</tr>
";
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
   <script>
        function showPopup() {
            document.getElementById('overlay').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</head>
<body>
<div class="page-container">


<div class="main">

<div class="charts">

<div class="charts-card">
    <h2 class="chart-title">Courses</h2>
    <div id="bar-chart"></div>
</div>

<div class="charts-card">
    <h2 class="chart-title">Faculties</h2>
    <div id="donut-chart"></div>
</div>
   
</div>

<div class="table-block">

<input type="text" id="search" name="search" placeholder="Search....">
<button class="submit-student" onclick="showPopup()">Add Student</button>

    <table id='responsive-table' class='responsive-table'>
    
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Full Name</th>
                <th>E-Mail</th>
                <th>Course</th>
                <th>Action</th>
            </tr>

            <thead>
            <tbody>
            <?php echo $tr; ?>
            </tbody>
    </table>
    
</div>

</div>
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="viewContent"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="editModalLabel">User Details</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="editContent"></div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<!-- <div id="editModal" class="overlay">
    <div class="popup">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2>Update Student Details</h2>
            <form method="post" action="insert.php">

                <div class="form-group StdNumber">
                    <label for="StdNumber">Student Number</label>
                    <input type="text" id="StdNumber" name="StdNumber" placeholder="Enter your student">
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
  </div> -->

  <!-- Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div id="modalFormContent"></div>
    </div>
  </div>

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
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteRecordButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
   
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="../../extensions/Editor/js/dataTables.editor.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <!-- Appex Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>


