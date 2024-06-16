<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <style>
    .subject-box {
      border: 2px solid #5FBDFF;
      padding: 10px;
      margin: 10px;
      background-color: #E0F7FF;
      border-radius: 5px;
      text-align: center;
    }
  </style>
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
          <i class="fas fa-search"></i> -->
        </a>
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
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
              </p>
            </a>
            
                   <li class="nav-item">                
                    <a href="../logout.php" class="nav-link">
                      <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;
                     <p>Sign-out</p>
                    </a>
                  </li>
                  
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
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Dashboard</li>
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


          <?php
            // Include the database connection file
            include '../db.php';

            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // Fetch the user's profile information from the database
                $userId = $_SESSION['user_id'];
                // $userId = 'user_id';
                $query = "SELECT * FROM students WHERE user_id = $userId";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $user = mysqli_fetch_assoc($result);
                    $full_name = $user['full_name'];
                    $email = $user['Email'];
                  } else {
                    $full_name = "User not found";
                    $email = "N/A";
                }
            } else {
                $full_name = "User ID not set in session";
                $email = "N/A";
            }

            // Close connection
            mysqli_close($conn);
            ?>
                       
                <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">  
                <h3 class="profile-username text-center"><?php echo($full_name); ?></h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Email:</b> <a class="float-right"><?php echo($email); ?></a>
                    </li>
                </ul>
            </div>
              </div>

              <?php
              include '../db.php';

              // Check if the user is logged in
              if (!isset($_SESSION['user_id'])) {
                  header("Location: ../loginform.php");
                  exit();
              }

              // Fetch user profile information
              $userId = $_SESSION['user_id'];
              $query = "SELECT * FROM students WHERE user_id = $userId";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) == 1) {
                  $user = mysqli_fetch_assoc($result);
                  $full_name = $user['full_name'];
                  $email = $user['Email'];
              } else {
                  $full_name = "User not found";
                  $email = "N/A";
              }

              // Fetch user subjects
              $subject_query = "SELECT subject_name FROM subjects WHERE user_id = $userId";
              $subject_result = mysqli_query($conn, $subject_query);

              // Close the database connection
              mysqli_close($conn);
              ?>
              
              <?php
                  // Example database connection and query
                  include '../db.php';

                  
              // Check the connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

                
              if(isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                // $useId = 'user_id';
              // Query to fetch the first row
              $sql = "SELECT * FROM students WHERE user_id = $userId";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
              } else {
                $row = array(); // No rows found, initialize an empty array
              }
            }

              ?>

              
                <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-graduation-cap mr-1"></i> Course: </strong>
                <p><?php echo isset($row['course']) ? $row['course'] : 'N/A'; ?></p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Gender: </strong>
                <p><?php echo isset($row['gender']) ? $row['gender'] : 'N/A'; ?></p>
                <hr>
                <strong><i class="fas fa-graduation-cap mr-1"></i> Status: </strong>
                <p><?php echo isset($row['status']) ? $row['status'] : 'N/A'; ?></p>
                <hr>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-3">
              <div class="col-sm-12">
                  <h5 class="nav-item" style="border: 3px solid #000; padding: 5px; border-color:#5FBDFF; text-align: center; background-color: #5FBDFF ;">Add subject</h5>
                                 
              </div><!-- /.card-header -->

                  <div class="tab-pane" id="settings">
                      <!-- Display error message if user input exists -->
                   <?php if (isset($_GET['error'])) { ?>
                        <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?>
                    <?php } ?>
                     
                             <!-- Display error message if user input exists -->
                   <?php if (isset($_GET['success'])) { ?>
                        <div id="successAlert" class="alert alert-success"><?php echo $_GET['success']; ?>
                    <?php } ?>
                    <br>

                    <form class="form-horizontal" action="add_subject.php" method="POST">
                    <form class="form-horizontal">
                      <div class="form-group row text-center">
                        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-9">
                        <select type="text" class="form-control" id="subject" name="subject">
                        <option value="" disabled selected >Select Subject</option>
                            <option>Test</option>
                            <option>Test</option>
                            <option>Test</option>
                            <option>Test</option>
                            <option>Test</option>
                            </select>
                    </div>
                   </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-box" name="add_subject" value="add_subject" id="submitBtn">Add</button>
                </div>
                </div>
                </div>

                               <!-- Display user subjects -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Your Subjects</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <?php while ($subject_row = mysqli_fetch_assoc($subject_result)) { ?>
                    <div class="col-md-4">
                      <div class="subject-box">
                        <?php echo htmlspecialchars($subject_row['subject_name']); ?>
                      </div>
                    </div>
                  <?php } ?>
                   </form>
                    </form>
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
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

</body>
</html>
