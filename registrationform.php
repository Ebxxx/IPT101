<!DOCTYPE html>
<html>
<head>
    <!-- title of the page-->
    <title>REGISTER</title>
       <!--External bootsrap file-->
    <link rel="Stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- External css file -->
    <link rel="Stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- column set to he center -->
            <div class="col-md-6 offset-md-3">
                <!--form wrapper with styling -->
                <div class="form-wrapper mt-5">
                    <!--Title of the form-->
                    <h2 class="text-center mb-4">REGISTRATION</h2>
                    <!-- Display error message if user input exists -->
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
                    <?php } ?>
                        <!--Registration form with varous input lentgh-->
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label for="username">User name:</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="Last_name">Last name:</label>
                            <input type="text" class="form-control" name="Last_name">
                        </div>
                        <div class="form-group">
                            <label for="First_name">First name:</label>
                            <input type="text" class="form-control" name="First_name">
                        </div>
                        <div class="form-group">
                            <label for="Middle_name">Middle name:</label>
                            <input type="text" class="form-control" name="Middle_name">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" name="Email">
                        </div>  
                        <div class="form-group">
                            <label for="Status">Status:</label>
                            <input type="text" class="form-control" name="Status">
                        </div><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <br><br>
                        <!-- link to loginform -->
                        <a href="loginform.php">Click to Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
