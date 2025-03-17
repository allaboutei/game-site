<?php
include_once("config/regdbconnect.php");

if (isset($_POST["btnCreate"])) {
    $createname = $_POST['cname'];
    $createemail = $_POST['cemail'];
    $createpassword = $_POST['cpassword'];

    $sqlCheck = "SELECT * FROM tbl_user";
    $resultCheck = $conn->query($sqlCheck);

    while ($rowCheck = $resultCheck->fetch_assoc()) {

        
        if ($rowCheck['userEmail'] == $createemail) {
            $_SESSION['cerrors'] = "Email Already Exists";
            header("location:register.php");
            exit();
        } 
        
        elseif ($rowCheck['userName'] == $createname) {
            $_SESSION['cerrors'] = "Username Already Taken";
            header("location:register.php");
            exit();
        } 
    }

    
    $sql = "INSERT INTO tbl_user (userId, userEmail, userPassword, userName, userRoleId, status) 
            VALUES (NULL, '$createemail', md5('$createpassword'), '$createname', '0', '1')";
    
    if ($conn->query($sql) === true) {

        $sql = "SELECT * FROM tbl_user WHERE userName='$createname' AND userPassword=md5('$createpassword') AND status='1'";
        $result = $conn->query($sql);

        if ($result) {
            session_start();
            $row = $result->fetch_assoc();
            $authType = $row['userRoleId'];
            $userid = $row['userId'];
            $email=$row['userEmail'];
        } else {
            echo "Error: ";
            exit();
        }

   
        if ($authType == 0) {
            $_SESSION['userName'] = $createname;
            $_SESSION['userRoleId'] = $authType;
            $_SESSION['userId'] = $userid;
            $_SESSION['userEmail'] = $email;
            $_SESSION['role'] = "user";
            

            header("location:index.php");
            exit();
        } else {
            $_SESSION['userName'] = $createname;
            $_SESSION['userRoleId'] = $authType;
            $_SESSION['userId'] = $userid;
            $_SESSION['userEmail'] = $email;
            $_SESSION['role'] = "admin";

            header("location:index.php");
            exit();
        }
    } else {
         $_SESSION['cerrors']="Account Creation Error";
        header("location:register.php");
    }
}

if (isset($_POST["btnLogin"])) {

    $name = $_POST['uname'];
    $password = $_POST['upw'];

    $sql = "SELECT * FROM tbl_user WHERE userName='$name' AND userPassword=md5('$password') AND status='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    $authType = $row['userRoleId'];
    $userid = $row['userId'];
    $email = $row['userEmail']; 

    if ($authType == 0) {
        $_SESSION['userName'] = $name;
        $_SESSION['userRoleId'] = $authType;
        $_SESSION['userId'] = $userid;
        $_SESSION['role'] = "user";
        $_SESSION['userEmail'] = $email;
        header("location:dispelshome.php");
        exit();
    } else {
        $_SESSION['userName'] = $name;
        $_SESSION['userRoleId'] = $authType;
        $_SESSION['userId'] = $userid;
        $_SESSION['role'] = "admin";
        $_SESSION['userEmail'] = $email;
        header("location:dispelshome.php");
        exit();
    }
} else {
    session_start(); // Ensure the session is started if login fails
    $_SESSION['errors'] = "Invalid username or password.";
    header("location:login.php");
    exit();
}

}

$conn->close();
?>
