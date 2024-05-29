<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

       <?php if (isset($_GET['error'])) { ?>
            <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?></div>
        <?php } ?>

      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="text" id="username" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submitBtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <p class="mb-0">
        <a href="registrationform.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if the browser supports local storage
    if (typeof(Storage) !== "undefined") {
      // Retrieve values from local storage and set them as input values
      document.getElementById("username").value = localStorage.getItem("username") || '';
      document.getElementById("password").value = localStorage.getItem("password") || '';

      // Store input values in local storage when the form is submitted
      document.getElementById("submitBtn").addEventListener("click", function() {
        localStorage.setItem("username", document.getElementById("username").value);
        localStorage.setItem("password", document.getElementById("password").value);

        // Mark the form as submitted
        document.querySelector("form").submitted = true;
      });

      // Clear local storage when navigating away from the page without submitting the form
      window.addEventListener('beforeunload', function(event) {
        if (!document.querySelector("form").submitted) {
          localStorage.removeItem("username");
          localStorage.removeItem("password");

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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
