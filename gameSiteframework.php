<!DOCTYPE html>
<html lang="en">
<?php
include_once("config/regdbconnect.php");
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"Page Name"</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/cf47e7251d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
if ($conn->query($sqlDelete) == true) {
    echo "<h3 class='noti'>User is deactivated successfully</h3>";
    echo "<div class='loader mg0Auto'></div>";
    header("refresh:1,url=userlist.php");
    exit();
} else {
    
        echo "<h3 class='noti'>Please Select A Team</h3>";
        echo "<i class='fa-solid fa-triangle-exclamation'></i>";
        header("refresh:1,url=userlist.php");
        
    
}

?>
<body>
    <div class="container">
        <div class="header">
            <?php
            include ("header.php");
            ?>
        </div>
        <div class="main">


       
        </div>
        <div class="footer">
            <?php
            include ("footer.php");
            ?>
        </div>
    </div>
    <?php
    ob_end_flush();
    ?>
    <script src="script.js"></script>
</body>

</html>