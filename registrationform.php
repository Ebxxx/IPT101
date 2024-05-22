<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="register.php" class="h1"><b>Admin</b>LTE</a>
       <!-- Display error message if user input exists -->
                   <?php if (isset($_GET['error'])) { ?>
                        <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?>
                    <?php } ?>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register.php" method="POST">

        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control" name="username" placeholder="username"pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]+$" title="Username must  contain alpha-numeric characters and underscores" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
           <input id="Last_name" type="text" class="form-control" name="Last_name" placeholder="Last name" pattern="[A-Za-z]+" title="Please enter letters only" required>          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="First_name" type="text" class="form-control" name="First_name" placeholder="First name"pattern="[A-Za-z]+" title="Please enter letters only" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="Middle_name" type="text" class="form-control" name="Middle_name" placeholder="Middle name" pattern="[A-Za-z]+" title="Please enter letters only">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="Email" type="email" class="form-control" name="Email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <select  type="text" class="form-control" name="Status" required>
        <option value="" disabled selected>Status</option>
        <option value="Single">Single</option>
        <option value="in Relationships">in Relationships</option>
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
       
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submitBtn" class="btn btn-primary btn-block">Register</button><br>
            <button type="button" id="clearBtn" class="btn btn-secondary">Clear</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

  
      <a href="loginform.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
 <script src="js/register.js"></script>
<script>
  if (typeof(Storage) !== "undefined") {
    // Retrieve values from local storage and set them as input values
    document.getElementById("username").value = localStorage.getItem("username");
    document.getElementById("password").value = localStorage.getItem("password");
    document.getElementById("Last_name").value = localStorage.getItem("Last_name");
    document.getElementById("First_name").value = localStorage.getItem("First_name");
    document.getElementById("Middle_name").value = localStorage.getItem("Middle_name");
    document.getElementById("Email").value = localStorage.getItem("Email");
    document.getElementById("Status").value = localStorage.getItem("Status");
     // Store input values in local storage when the form is submitted

    document.getElementById("submitBtn").addEventListener("click", function() {
        localStorage.setItem("username", document.getElementById("username").value);
        localStorage.setItem("password", document.getElementById("password").value);
        localStorage.setItem("Last_name", document.getElementById("Last_name").value);
        localStorage.setItem("First_name", document.getElementById("First_name").value);
        localStorage.setItem("Middle_name", document.getElementById("Middle_name").value);
        localStorage.setItem("Email", document.getElementById("Email").value);
        localStorage.setItem("Status", document.getElementById("Status").value);

        // Mark the form as submitted
        document.querySelector("form").submitted = true;
    });

    // Clear input fields when the clear form button is clicked
    document.getElementById("clearBtn").addEventListener("click", function() {
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("Last_name").value = "";
        document.getElementById("First_name").value = "";
        document.getElementById("Middle_name").value = "";
        document.getElementById("Email").value = "";
        document.getElementById("Status").value = "";
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
