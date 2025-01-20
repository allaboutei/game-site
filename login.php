<?php
$currentPage = 'login';
include_once("config/regdbconnect.php");
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cf47e7251d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon"> 
</head>

<body>
    <div class="container">
        <div class="header">
            <?php include("header.php"); ?>
        </div>

        <div class="main">
            <div class="loginWrapper">
                <!-- Image Section -->
                <div class="loginImage">
                    <img src="images/DISPELS.jpg" alt="Login Banner">
                </div>
                <!-- Form Section -->
                <div class="Form">
                    <h2>Welcome Back</h2>
                    <p>Login to access your eSports profile and participate in tournaments.</p>
                    <?php include_once("./errors/login_error.php"); ?>
                    <form action="loginAuth.php" method="POST">
                        <div class="formGroup">
                            <label for="uname">User Name</label>
                            <input id="uname" name="uname" type="text" class="form-control" required>
                        </div>
                        <div class="formGroup">
                            <label for="upw">Password</label>
                            <input id="upw" name="upw" type="password" class="form-control" required>
                        </div>
                        <div class="formGroup">
                            <input name="btnLogin" class="btn btn-primary" type="submit" value="Login">
                        </div>
                    </form>
                    <div class="createLogin">
                        <span>Don't have an account?</span>
                        <a href="register.php">Create an account</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <?php include("footer.php"); ?>
        </div>
    </div>
</body>
</html>
