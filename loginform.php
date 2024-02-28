

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-wrapper {
            background-color:   rgb(57, 144, 225);
            box-shadow: 0 6px 10px rgb(0, 0, 0, 0.741);
            padding: 20px;
            border-radius: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-wrapper mt-5">
                    <h2 class="text-center mb-4">LOGIN</h2>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
                    <?php } ?>

                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label for="username">User name:</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Submit</button><br><br>
					

						<a href="registrationform.php">Click to register</a>
						
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>