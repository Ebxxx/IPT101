<?php
session_start();
include "profile_details.php";
include "get_image.php";
include "db.php";
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> -->
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
             </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"></li>
   
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Dashboard
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>        
            <ul class="nav nav-treeview">
            <li class="nav-item">                
                    <a href="index_admin/enroll_students.php" class="nav-link">
                      <i class="fas fa-graduation-cap mr-1" ></i>&nbsp;&nbsp;
                     <p>Students</p> 
                    </a>
                  </li>

                  <br>

              <li class="nav-item">
                <a href="edit_profile.php" class="nav-link">
                  <i class="fa fa-user"></i>&nbsp;&nbsp;
                  <p>Edit Profile</p>
                </a>
              </li>
              


               <li class="nav-item">                
                    <a href="security_dash.php" class="nav-link">
                      <i class="fa fa-unlock-alt" ></i>&nbsp;&nbsp;
                     <p>Security Settings</p> 
                    </a>
                  </li>
                  <br>
            
                   <li class="nav-item">                
                    <a href="logout.php" class="nav-link">
                      <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;
                     <p>Sign-out</p>
                    </a>
                  </li>
        </ul>
      </nav>
<!-- /end of nav bar -->

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">: - )</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

          
         <!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
        <?php 
        if (!empty($profile_picture)): ?>
            <img src="data:image;base64, <?php echo base64_encode($profile_picture); ?>" alt="Profile Picture" class="profile-user-img img-fluid img-circle">
        <?php else: ?>
            <img class="profile-user-img img-fluid img-circle" src="uploads/avatar.png" alt="Blank profile picture">
        <?php endif; ?>

        </div>

        
                  <h3 class="profile-username text-center"><?php echo $row['username']; ?></h3>
                  <p class="text-center"><?php echo $full_name ?></p>
                  <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email:</b> <a class="float-right"><?php echo $row['Email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Soc med:</b> <a class="float-right"><?php echo $user['social_media']; ?></a>
                  </li>
                </ul>
              </div>
            </div>


            <?php
 
              // Check the connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
              // Query to fetch the first row
              $sql = "SELECT * FROM user_profile WHERE user_id = $userId";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
              } else {
                $row = array(); // No rows found, initialize an empty array
              }
            }

              if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
               // Query to fetch the first row from user table
              $sql_user = "SELECT * FROM user WHERE user_id = $userId";
              $result_user = $conn->query($sql_user);

              // Check if the query was successful
              if ($result_user->num_rows > 0) {
                  $row_user = $result_user->fetch_assoc();
              } else {
                  $row_user = array(); // No rows found, initialize an empty array
              }
            }

              $conn->close();
              ?>
              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Contact info:</strong>
                    <p><?php echo isset($row['phone_number']) ? $row['phone_number'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address: </strong>
                    <p><?php echo isset($row['address']) ? $row['address'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="fas fa-birthday-cake"></i> Date of birth:</strong>
                    <p><?php echo isset($row['date_of_birth']) ? $row['date_of_birth'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="fas fa-venus-mars mr-1"></i> Gender: </strong>
                    <p><?php echo isset($row['gender']) ? $row['gender'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="fas fa-graduation-cap mr-1"></i> Education: </strong>
                    <p><?php echo isset($row['education']) ? $row['education'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="far fas fa-briefcase mr-1"></i> Job: </strong>
                    <p><?php echo isset($row['job']) ? $row['job'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="farfas fa-laptop-code mr-1"></i> Skills: </strong>
                    <p><?php echo isset($row['skills']) ? $row['skills'] : 'N/A'; ?></p>
                    <hr>

                 
                    </p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            <div class="card card-primary">
                      
            </div> 
          </div>
     
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-3">
              <div class="col-sm-12">
                  <h5 class="nav-item" style="border: 3px solid #000; padding: 5px; border-color:#5FBDFF; text-align: center; background-color: #5FBDFF ;">Security Settings</h5>
                                 
              </div><!-- /.card-header -->
              
                  <div class="tab-pane" id="settings">
                      <!-- Display error message if user input exists -->
                       <?php
                            if (isset($_SESSION['user_pass_error'])) {
                                echo "<div class='alert alert-danger'>{$_SESSION['user_pass_error']}";
                                unset($_SESSION['user_pass_error']);
                            }
                            if (isset($_SESSION['user_pass_success'])) {
                                echo "<div class='alert alert-success'>{$_SESSION['user_pass_success']}";
                                unset($_SESSION['user_pass_success']);
                            }
                        ?>
                        <br>
                        <br>
                    <form action="user_pass_action.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter Current Password" value="">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" value="">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" value="">
                            </div>
                            <input type="hidden" id="usedPasswords" name="usedPasswords">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                  </div>
                    <!-- /.tab-pane -->

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- ./Script for user input validation -->
<script>
    // Check if the browser supports local storage
    if (typeof(Storage) !== "undefined") {
      //  // Retrieve values from local storage and set them as input values
        // document.getElementById("Last_name").value = localStorage.getItem("Last_name");
        // document.getElementById("First_name").value = localStorage.getItem("First_name");
        // document.getElementById("Middle_name").value = localStorage.getItem("Middle_name");
        // document.getElementById("phone_number").value = localStorage.getItem("phone_number");
        // document.getElementById("country_code").value = localStorage.getItem("country_code");
        // document.getElementById("address").value = localStorage.getItem("address");
        // document.getElementById("date_of_birth").value = localStorage.getItem("date_of_birth");
        // document.getElementById("gender").value = localStorage.getItem("gender");
        // document.getElementById("social_media").value = localStorage.getItem("social_media");
        // document.getElementById("education").value = localStorage.getItem("education");
        // document.getElementById("job").value = localStorage.getItem("job");
        // document.getElementById("skills").value = localStorage.getItem("skills");
         document.getElementById("currentPassword").value = localStorage.getItem("currentPassword");
         document.getElementById("newPassword").value = localStorage.getItem("newPassword");
         document.getElementById("confirmPassword").value = localStorage.getItem("confirmPassword");

        // Store input values in local storage when the form is submitted
        document.getElementById("submitBtn").addEventListener("click", function() {
            // localStorage.setItem("Last_name", document.getElementById("Last_name").value);
            // localStorage.setItem("First_name", document.getElementById("First_name").value);
            // localStorage.setItem("Middle_name", document.getElementById("Middle_name").value);
            // localStorage.setItem("phone_number", document.getElementById("phone_number").value);
            // localStorage.setItem("country_code", document.getElementById("country_code").value);
            // localStorage.setItem("address", document.getElementById("address").value);
            // localStorage.setItem("date_of_birth", document.getElementById("date_of_birth").value);
            // localStorage.setItem("gender", document.getElementById("gender").value);
            // localStorage.setItem("social_media", document.getElementById("social_media").value);
            // localStorage.setItem("education", document.getElementById("education").value);
            // localStorage.setItem("job", document.getElementById("job").value);
            // localStorage.setItem("skills", document.getElementById("skills").value);
            localStorage.setItem("currentPassword", document.getElementById("currentPassword").value);
            localStorage.setItem("newPassword", document.getElementById("newPassword").value);
            localStorage.setItem("confirmPassword", document.getElementById("confirmPassword").value);
            // Mark the form as submitted
            document.querySelector("form").submitted = true;
        });

        // Clear local storage when navigating away from the page without submitting the form
        window.addEventListener('beforeunload', function(event) {
            if (!document.querySelector("form").submitted) {
                // localStorage.removeItem("Last_name");
                // localStorage.removeItem("First_name");
                // localStorage.removeItem("Middle_name");
                // localStorage.removeItem("phone_number");
                // localStorage.removeItem("country_code");
                // localStorage.removeItem("address");
                // localStorage.removeItem("date_of_birth");
                // localStorage.removeItem("gender");
                // localStorage.removeItem("social_media");
                // localStorage.removeItem("education");
                // localStorage.removeItem("job");
                // localStorage.removeItem("skills");
                localStorage.removeItem("currentPassword");
                localStorage.removeItem("newPassword");
                localStorage.removeItem("confirmPassword");

                // Hide the error message if it is currently displayed
                var errorAlert = document.getElementById("errorAlert");
                if (errorAlert) {
                    errorAlert.style.display = "none";
                }
                var successAlert = document.getElementById("successAlert");
                if (successAlert) {
                    successAlert.style.display = "none";
                }
            }
        });

        // Remove the error message from the URL
        if (window.history.replaceState) {
            const url = new URL(window.location.href);
            url.searchParams.delete('error');
            window.history.replaceState({ path: url.href }, '', url.href);
        }

        // Remove the success message from the URL
        if (window.history.replaceState) {
            const url = new URL(window.location.href);
            url.searchParams.delete('success');
            window.history.replaceState({ path: url.href }, '', url.href);
        }

        // Clear the error message after refreshing the page
        window.addEventListener('load', function() {
            const errorMessage = document.getElementById('error');
            if (errorMessage) {
                setTimeout(() => errorMessage.style.display = 'none', 5000);
            }

            // Clear the success message after refreshing the page
            const successMessage = document.getElementById('success');
            if (successMessage) {
                setTimeout(() => successMessage.style.display = 'none', 5000);
            }
        });
    } else {
        // Local storage is not supported
        alert("Sorry, your browser does not support web storage. Your inputs will not be saved.");
    }

    //     document.getElementById('country_code').addEventListener('change', function() {
    //     var countryCode = this.value;
    //     var phoneNumberInput = document.getElementById('phone_number');
    //     phoneNumberInput.value = countryCode;
    //     phoneNumberInput.setAttribute('placeholder', countryCode);
    // });

    // document.getElementById('phone_number').addEventListener('input', function() {
    //     var countryCode = document.getElementById('country_code').value;
    //     var phoneNumber = this.value;
    //     var fullNumber = phoneNumber.startsWith(countryCode) ? phoneNumber : countryCode + phoneNumber;

    //     if (!validatePhoneNumber(fullNumber)) {
    //         this.setCustomValidity('Phone number does not match the selected country code.');
    //     } else {
    //         this.setCustomValidity('');
    //     }
    // });

    // function validatePhoneNumber(phoneNumber) {
    //     // A basic example of phone number validation
    //     var regex = /^\+\d{1,3}\d{6,14}$/; // Adjust this regex based on your requirements
    //     return regex.test(phoneNumber);
    // }
</script>



<!-- jQuery -->
<script type="js/edit.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>