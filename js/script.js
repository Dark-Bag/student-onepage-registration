

$(document).ready(function() {
    // Event listener for delete button click
    $('.deleteButton').click(function() {
      var id = $(this).data('id');
      $('#deleteRecordButton').data('id', id); // Store the ID in the delete button data-id attribute
      $('#deleteConfirmationModal').modal('show'); // Show the confirmation modal
    });
  
    // Event listener for confirm delete button click
    $('#deleteRecordButton').click(function() {
      var id = $(this).data('id');
      deleteRecord(id); // Call the deleteRecord function with the ID as a parameter
    });
  
    // Function to delete the record using AJAX
    function deleteRecord(id) {
      $.ajax({
        url: 'delete.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
          // Handle the success response
          console.log('Record deleted successfully');
          // Reload the table or perform any other necessary actions
          // For example, you can refresh the page to update the table
          location.reload();
        },
        error: function(xhr, status, error) {
          // Handle the error response
          console.error('Error deleting record:', error);
        }
      });
    }
  });

 
  $(document).ready(function() {
    // Function to fetch user details and populate form inputs in the modal
    function fetchUserDetails(id) {
      $.ajax({
        url: 'fetch_user_details.php', // Assuming the PHP code is in a separate file named 'fetch_user_details.php'
        method: 'POST',
        data: { id: id },
        success: function(response) {
          var userDetails = JSON.parse(response);
          $('#StdNumber').val(userDetails.stdNumber);
          $('#fullname').val(userDetails.fullName);
          $('#email').val(userDetails.email);
          $('#faculty').val(userDetails.faculty);
          $('#course').val(userDetails.course);
          $('#editDob').val(userDetails.dob);
          $('#gender').val(userDetails.gender);        },
        error: function() {
          $('#user-details').html('Error occurred while fetching user details.');
        }
      });
    }

    // Event listener for edit buttons in the table
    $('.edit-button').click(function() {
      var id = $(this).data('id');
      fetchUserDetails(id);
    });
  });


  $(document).ready(function() {
    // Map parent option values to their respective child options
    const childOptions = {
        science: ["DIPLOMA IN AGRICULTURE (ECP)", "DIPLOMA IN BIOTECHNOLOGY", "ND: ANALYTICAL CHEMISTRY (EXTENDED)"],
        business: ["DIPLOMA IN BUSINESS &INFO ADMINISTRATION", "ND: HOSPITALITY MNGT: ACCOMMODATION"],
        education: ["DIPLOMA IN GRADE R TEACHING", "B ED HON IN EDUCATIONAL MAN & LEADERSHIP", "B ED IN SENIOR PHASE AND FET TEACHING", "POST GRAD CERT IN EDUCATION: FET "],
        engineering: ["BACHELOR OF ENG TECH IN CHEMICAL ENG", "BACHELOR OF ENG TECH IN CIVIL ENG", "BACHELOR OF ENG TECH IN COMPUTER ENG"],
        health: ["BACH OF HEALTH SC IN MED LAB SCI", "BACHELOR OF HEALTH SC IN MED LAB SCIENCE"],
        design: ["DIPLOMA IN ARCHITECTURAL TECHNOLOGY(ECP)", "ND: ARCHITECTURAL TECHNOLOGY", "ADVANCED DIPLOMA IN FASHION", "DIPLOMA IN FILM PRODUCTION"]
    };

    // Handle change event of the parent select
    $("#faculty").change(function() {
        const selectedValue = $(this).val();
        const childSelect = $("#course");

        // Clear the child select options
        childSelect.empty();

        if (selectedValue !== "") {
            // Get the corresponding child options based on the selected parent option
            const options = childOptions[selectedValue];

            // Add the child options to the child select
            options.forEach(function(option) {
                childSelect.append($("<option>").val(option).text(option));
            });
        }
    });
});

document.getElementById("search").addEventListener("input", function() {
    var input = this.value.toLowerCase();
    var table = document.getElementById("responsive-table");
    var rows = table.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].textContent.toLowerCase();
        if (rowData.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
});
  
// Use AJAX to fetch data from index1.php
var xhr = new XMLHttpRequest();
xhr.open('GET', 'index1.php', true);
xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    var chartData = JSON.parse(xhr.responseText);
    renderChart(chartData);
    console.log(chartData);
  }
};
xhr.send();

// Render the chart with the fetched data
function renderChart(chartData) {
  var barChartOptions = {
    tooltip: {
      theme: 'dark',
      style: {
        fontSize: '12px',
        color: '#ffffff'
      }
    },
    chart: {
      type: 'bar',
      height: 350,
      width: '100%'
    },
    series: [
      {
        name: 'Number of Students',
        data: chartData.map(function(dataItem) {
          return dataItem.student_count;
        })
      }
    ],
    noData: {
  text: 'No data available',
  align: 'center',
  verticalAlign: 'middle',
  offsetX: 0,
  offsetY: 0,
  style: {
    fontSize: '14px',
    color: '#999'
  }
},
    xaxis: {
      categories: chartData.map(function(dataItem) {
        return dataItem.course;
      })
    }
  };

  var donutChartOptions = {
    chart: {
      type: 'line'
    },
    
    series: [
      {
        name: 'Number of Students',
        data: chartData.map(function(dataItem) {
    return {
      x: dataItem.faculty,
      y: dataItem.student_count
    };
  })
      }
    ],
    noData: {
  text: 'No data available',
  align: 'center',
  verticalAlign: 'middle',
  offsetX: 0,
  offsetY: 0,
  style: {
    fontSize: '14px',
    color: '#999'
  }
},
    xaxis: {
      categories: chartData.map(function(dataItem) {
        return dataItem.faculty;
      })
    }
  };

  var barChart = new ApexCharts(
    document.querySelector('#bar-chart'),
    barChartOptions
  );
  barChart.render();

  var donutChart = new ApexCharts(
    document.querySelector('#donut-chart'),
    donutChartOptions
  );
  donutChart.render();
}

$(document).ready(function() {
    // Event listener for view button click
    $(document).on('click', '.viewButton', function() {
      var id = $(this).data('id');
      fetchUserDetails(id);
    });
  
    // Function to fetch user details via AJAX
    function fetchUserDetails(id) {
      $.ajax({
        url: 'fetch_details.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
          // Update the modal content with the user details
          $('#viewContent').html(response);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching user details:', error);
        }
      });
    }
  });

  $(document).ready(function() {
    // Event listener for view button click
    $(document).on('click', '.editButton', function() {
      var id = $(this).data('id');
      fetchUserDetails(id);
    });
  
    // Function to fetch user details via AJAX
    function fetchUserDetails(id) {
      $.ajax({
        url: 'edit.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
          // Update the modal content with the user details
          $('#editContent').html(response);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching user details:', error);
        }
      });
    }
  });



  $(document).ready(function() {
    $('#responsive-table').DataTable({
        responsive: true,
        select: true
    });
  });  

  function openModal(id) {
    var modal = document.getElementById("editModal");
    modal.style.display = "block";
    loadFormContent(id);
  }

  function closeModal() {
    var modal = document.getElementById("editModal");
    modal.style.display = "none";
  }

  function loadFormContent(id) {
    var modalFormContent = document.getElementById("modalFormContent");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          modalFormContent.innerHTML = xhr.responseText;
          fetchRecordData(id);
        } else {
          modalFormContent.innerHTML = "Failed to load form.";
        }
      }
    };
    xhr.open("GET", "edit.php", true); // Change "form.html" to the actual path of your form file
    xhr.send();
  }