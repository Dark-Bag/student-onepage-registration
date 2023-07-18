<?php

// Create the SQL query
$sql = "SELECT * FROM students";

// Execute the query and fetch the result
$result = $db_conn->query($sql);

// Fetch all rows as an associative array
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
if (count($rows) > 0) {
    echo '<table>';
    echo '<tr><th>Student Number</th><th>Name</th><th>Email</th><th>City</th><th>Action</th></tr>';

    // Output data of each row
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['stdNumber'] . '</td>';
        echo '<td>' . $row['firstName'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['city'] . '</td>';
        echo '<td>';
        echo '<a>Edit</a>';
        echo ' | ';
        echo '<a>Delete</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No records found.";
}

?>
