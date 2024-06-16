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

     <script>
        function redirectToPage(userType) {
            if (userType === 'student') {
                window.location.href = 'index-student/student-registration-form.php';
            } else if (userType === 'admin') {
                window.location.href = 'registrationform.php';
            }
        }
    </script>
    
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="register.php" class="h1"><b>Admin</b>LTE</a>
       <!-- Display error message if user input exists -->
       <?php if (isset($_GET['error'])) { ?>
          <div id="errorAlert" class="alert alert-danger"><?php echo $_GET['error']; ?></div>
       <?php } ?>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <button onclick="redirectToPage('student')">Register as Student</button>
      <button onclick="redirectToPage('admin')">Register as Admin</button>
      <br>
    <br>
      <a href="loginform.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if the browser supports local storage
    if (typeof(Storage) !== "undefined") {
      // Retrieve values from local storage and set them as input values
      document.getElementById("username").value = localStorage.getItem("username") || '';
      document.getElementById("password").value = localStorage.getItem("password") || '';
      document.getElementById("Last_name").value = localStorage.getItem("Last_name") || '';
      document.getElementById("First_name").value = localStorage.getItem("First_name") || '';
      document.getElementById("Middle_name").value = localStorage.getItem("Middle_name") || '';
      document.getElementById("Email").value = localStorage.getItem("Email") || '';
      document.getElementById("Status").value = localStorage.getItem("Status") || '';

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

      // Clear local storage when navigating away from the page without submitting the form
      window.addEventListener('beforeunload', function(event) {
        if (!document.querySelector("form").submitted) {
          localStorage.removeItem("username");
          localStorage.removeItem("password");
          localStorage.removeItem("Last_name");
          localStorage.removeItem("First_name");
          localStorage.removeItem("Middle_name");
          localStorage.removeItem("Email");
          localStorage.removeItem("Status");

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
