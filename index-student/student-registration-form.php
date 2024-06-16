<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="student-register.php" class="h1"><b>Admin</b>LTE</a>
       <!-- Display error message if user input exists -->
       <?php if (isset($_GET['error'])) { ?>
          <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?></div>
       <?php } ?>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Student Registration form</p>

      <form action="student-register.php" method="POST">
        
        <div class="input-group mb-3">
          <input id="Last_name" type="text" class="form-control" name="Last_name" placeholder="Last name" pattern="[A-Za-z]+" title="Please enter letters only" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="First_name" type="text" class="form-control" name="First_name" placeholder="First name" pattern="[A-Za-z]+" title="Please enter letters only" required>
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
          <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
            <select id="gender" name="gender" class="form-control" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
          <input id="course" type="course" class="form-control" name="course" placeholder="course" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-briefcase"></span>
            </div>
          </div>
        </div>

       
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submitBtn" class="btn btn-primary btn-block">Register</button><br>
          </div>
          <!-- /.col -->
        </div>
  
      </form>
      <a href="../loginform.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if the browser supports local storage
    if (typeof(Storage) !== "undefined") {
      // Retrieve values from local storage and set them as input values
      document.getElementById("password").value = localStorage.getItem("password") || '';
      document.getElementById("Last_name").value = localStorage.getItem("Last_name") || '';
      document.getElementById("First_name").value = localStorage.getItem("First_name") || '';
      document.getElementById("Middle_name").value = localStorage.getItem("Middle_name") || '';
      document.getElementById("Email").value = localStorage.getItem("Email") || '';
      document.getElementById("course").value = localStorage.getItem("course") || '';

      // Store input values in local storage when the form is submitted
      document.getElementById("submitBtn").addEventListener("click", function() {
        localStorage.setItem("password", document.getElementById("password").value);
        localStorage.setItem("Last_name", document.getElementById("Last_name").value);
        localStorage.setItem("First_name", document.getElementById("First_name").value);
        localStorage.setItem("Middle_name", document.getElementById("Middle_name").value);
        localStorage.setItem("Email", document.getElementById("Email").value);
        localStorage.setItem("course", document.getElementById("course").value);

        // Mark the form as submitted
        document.querySelector("form").submitted = true;
      });

      // Clear local storage when navigating away from the page without submitting the form
      window.addEventListener('beforeunload', function(event) {
        if (!document.querySelector("form").submitted) {
          localStorage.removeItem("password");
          localStorage.removeItem("Last_name");
          localStorage.removeItem("First_name");
          localStorage.removeItem("Middle_name");
          localStorage.removeItem("Email");
          localStorage.removeItem("course");

          // Hide the error message if it is currently displayed
          var errorAlert = document.getElementById("errorAlert");
          if (errorAlert) {
            errorAlert.style.display = "none";
          }
        }
      });

      // Remove the error message from the URL
      if (window.history.replaceState) {
        const url = new URL(window.location.href);
        url.searchParams.delete('error');
        window.history.replaceState({ path: url.href }, '', url.href);
      }

      // Clear the error message after refreshing the page
      window.addEventListener('load', function() {
        const errorMessage = document.getElementById('errorAlert');
        if (errorMessage) {
          setTimeout(() => errorMessage.style.display = 'none', 5000);
        }
      });
    }
  });
</script>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
