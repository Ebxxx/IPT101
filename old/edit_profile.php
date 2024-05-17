<?php
session_start();
include_once "db.php";
include 'profile_details.php';
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
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>


                       <?php
                          $username = $_SESSION['username'];
                          // $first_name = $_SESSION['First_name'];
                          // $middle_name = $_SESSION['Middle_name'];
                          // $last_name =$_SESSION['last_name'];

                          // Query to get user information
                          $sql = "SELECT * FROM user WHERE username = '$username'";
                          $result = mysqli_query($conn, $sql);

                          // Check if the query was successful
                          if ($result && mysqli_num_rows($result) > 0) {
                              $row = mysqli_fetch_assoc($result);
                              $full_name = $row['First_name'] . ' ' . $row['Middle_name'] . ' ' . $row['Last_name'];
                              // Display user information
                          }

                          // Close database connection
                       mysqli_close($conn);
                    ?>

                  <!-- <h3 class="profile-username text-center"><?php echo $row['username']; ?></h3> -->
                  <h3 class="profile-username text-center"><?php echo $row['username']; ?></h3>
                  <p class="text-center"><?php echo $full_name ?></p>
              </div>
            </div>

            <div class="card card-primary">
                      
            </div> 
          </div>
     
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
               
                  <h5 class="nav-item">edit</h5>
                                 
              </div><!-- /.card-header -->
            

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="index_dash.php" method="POST">
                    <form class="form-horizontal">
                      <div class="form-group row text-center">
                        <label for="Last_name" class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Last_name" placeholder=" ">
                        </div>
                      </div>
                        <div class="form-group row text-center">
                        <label for="First_name" class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="First_name" placeholder=" ">
                        </div>
                      </div>
                       <div class="form-group row text-center">
                        <label for="Middle_name" class="col-sm-2 col-form-label">Middle name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Middle_name" placeholder=" ">
                        </div>
                      </div>
                      <div class="form-group row text-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder=" ">
                        </div>
                      </div>
                       <div class="form-group row text-center">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" placeholder=" ">
                        </div>
                      </div>
                      <div class="form-group row text-center">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone_number" placeholder=" ">
                        </div>
                      </div>
                      
                      <div class="form-group row text-center">
                        <label for="address" class="col-sm-2 col-form-label">address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="address" placeholder=" ">
                        </div>
                      </div>
                       <div class="form-group row text-center">
                        <label for="date_of_birth" class="col-sm-2 col-form-label">date of birth</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="date_of_birth" placeholder=" ">
                        </div>
                      </div>
                      <div class="form-group row text-center">
                          <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                          <div class="col-sm-10">
                              <select type="text" class="form-control" id="gender">
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
                          <input type="text" class="form-control" id="social_media" placeholder=" ">
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
            <button type="submit" class="btn btn-primary btn-box">submit</button>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>x