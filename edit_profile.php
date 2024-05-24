<?php
session_start();
include "profile_details.php";
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
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
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
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
             </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"></li>
   
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Menu
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="edit_profile.php" class="nav-link">
                  <p>Edit Profile</p>
                </a>
              </li>

                   <li class="nav-item">
                    <a href="loginform.php" class="nav-link">
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
              <li class="breadcrumb-item active">User Profile</li>
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
                  <img src="<?php echo (!empty($user['profile_picture'])) ? 'uploads/' . $user['profile_picture'] : 'uploads/avatar.png'; ?>" class="profile-user-img img-fluid img-circle" alt="Profile Picture" width="80">

                 <!--  <img class="profile-user-img img-fluid img-circle"
                  src="<?php echo $user['profile_picture']; ?>" class="img-fluid rounded-circle" alt="Profile Picture" width="80" > -->

                </div>

                  <!-- <h3 class="profile-username text-center"><?php echo $row['username']; ?></h3> -->
                  <h3 class="profile-username text-center"><?php echo $row['username']; ?></h3>
                  <p class="text-center"><?php echo $full_name ?></p>
                  <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email:</b> <a class="float-right"><?php echo $row['Email']; ?></a>
                  </li>
                </ul>
              </div>
            </div>
            <?php
                  // Example database connection and query
                  include 'db.php';

                  
              // Check the connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              // Query to fetch the first row
              $sql = "SELECT phone_number, address, date_of_birth, gender, social_media FROM user_profile LIMIT 1";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
              } else {
                $row = array(); // No rows found, initialize an empty array
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

                    <strong><i class="far fa-file-alt mr-1"></i> Gender: </strong>
                    <p><?php echo isset($row['gender']) ? $row['gender'] : 'N/A'; ?></p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Social Media: </strong>
                    <p><?php echo isset($row['social_media']) ? $row['social_media'] : 'N/A'; ?></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            <div class="card card-primary">
                      
            </div> 
          </div>
     
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
               
                  <h5 class="nav-item">edit</h5>
                                 
              </div><!-- /.card-header -->
            

                  <div class="tab-pane" id="settings">
                      <!-- Display error message if user input exists -->
                   <?php if (isset($_GET['error'])) { ?>
                        <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?>
                    <?php } ?>

                    <form class="form-horizontal" action="update_profile.php" method="POST">
                    <form class="form-horizontal">
                      <div class="form-group row text-center">
                        <label for="Last_name" class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Last_name" name="Last_name" placeholder=" " required>
                        </div>
                      </div>
                        <div class="form-group row text-center">
                        <label for="First_name" class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="First_name" name="First_name" placeholder=" " required>
                        </div>
                      </div>
                       <div class="form-group row text-center">
                        <label for="Middle_name" class="col-sm-2 col-form-label">Middle name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Middle_name" name="Middle_name" placeholder=" ">
                        </div>
                      </div>
                      <!-- <div class="form-group row text-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="Email" name="Email" placeholder=" " readonly="true">
                        </div>
                      </div> -->
                       <!-- <div class="form-group row text-center">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                        </div>
                      </div> -->
                      <div class="form-group row text-center">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder=" ">
                        </div>
                      </div>
                      
                      <div class="form-group row text-center">
                        <label for="address" class="col-sm-2 col-form-label">address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="address" name="address" placeholder=" ">
                        </div>
                      </div>
                       <div class="form-group row text-center">
                        <label for="date_of_birth" class="col-sm-2 col-form-label">date of birth</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder=" " required>
                        </div>
                      </div>
                      <div class="form-group row text-center">
                          <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                          <div class="col-sm-10">
                              <select type="text" class="form-control" id="gender" name="gender" required>
                                  <option value="" disabled selected></option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                  <option value="other">Other</option>
                              </select>
                          </div>
                      </div>
                       <!-- <div class="form-group row text-center">
                        <label for="gender" class="col-sm-2 col-form-label">gender</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="gender" placeholder=" ">
                        </div>
                      </div> -->

                       <div class="form-group row text-center">
                        <label for="social_media" class="col-sm-2 col-form-label">social_media</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="social_media" name="social_media" placeholder=" ">
                        </div>
                      </div> 
                      <div class="form-group row text-center">
                        <label for="profile_picture" class="col-sm-2 col-form-label">Profile Picture</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                          </div>
                      </div>

                    <!--   <div class="form-group row text-center">
                        <label for="profile_picture" class="col-sm-2 col-form-label">profile_picture</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="profile_picture" placeholder=" ">
                        </div>
                      </div> -->
                      <div class="col-4">
            <button type="submit" class="btn btn-primary btn-box" name="edit_profile" value="Update Profile" id="submitBtn" >submit</button>
          </div>


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
<script type="js/edit.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>x