<?php
$currentPage = 'teamreg';
include_once("config/regdbconnect.php");
session_start();
ob_start();
isset($_SESSION['role']) ? $role = $_SESSION['role'] : $role = "Not Logged In";
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/cf47e7251d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="container">
        <div class="header">
            <?php
            include("header.php");
            ?>
        </div>
        <div class="main"><?php

                            if (isset($_POST["btnSubmit"])) {
                                $name = $_POST["tname"];
                                $email = $_POST["temail"];
                                $phno = $_POST["tno"];

                                if (isset($_FILES["tfile"]) && $_FILES["tfile"]["error"] == 0) {
                                    $filename = $_FILES["tfile"]["name"];
                                    $filepatch = $_FILES["tfile"]["tmp_name"];
                                    move_uploaded_file($filepatch, "uploadfiles/" . $filename);
                                } else {
                                    $filename = "";
                                }

                                if (isset($_POST["editId"])) {
                                    $editId = $_POST["editId"];
                                    $sql = "UPDATE tbl_team SET teamName='$name', teamEmail='$email', teamPhno='$phno', teamImage='$filename' WHERE teamId=' $editId'";
                                    if ($conn->query($sql) == True) {
                                        echo "<div>Successfully Updated One Record!</div>";
                                        header("location:teamreg.php");
                                        exit();
                                    }
                                } else {
                                    $sql = "INSERT INTO tbl_team (teamId, teamName, teamEmail, teamPhno, teamImage,assignedTour) VALUES (NULL, '$name','$email', '$phno','$filename','0')";
                                    if ($conn->query($sql) == True) {
                                        echo "Record inserted successfully";
                                        header("location:teamreg.php");
                                        exit();
                                    } else {
                                        echo "Insertion Error";
                                    }
                                }
                            }




                            $editRow = null;
                            if (isset($_GET["editid"])) {
                                $eid = $_GET["editid"];
                                $sql = "SELECT * from tbl_team WHERE teamId='$eid'";
                                $result = $conn->query($sql);
                                $editRow = $result->fetch_assoc();
                            }


                            if (isset($_GET["deleteid"])) {
                                $delid = $_GET["deleteid"];
                                $sqlCheck = "SELECT * FROM tbl_allocate ta
                    JOIN tbl_team tt ON ta.teamId=tt.teamId
                     WHERE ta.teamId='$delid'";
                                $resultCheck = $conn->query($sqlCheck);
                                if ($resultCheck->num_rows > 0) {
                                    echo "<div>Error deletion! There are allocated players in this team</div>";
                                    echo "<i class='fa-solid fa-triangle-exclamation'></i>";
                                    header("refresh:1,url=teamreg.php");
                                } else {
                                    $sql = "DELETE FROM tbl_team WHERE teamId = '$delid'";
                                    if ($conn->query($sql) == TRUE) {
                                        echo "<div> Team deleted successfully</div>";
                                        echo "<div class='loader mg0Auto'></div>";
                                        header("location:teamreg.php");
                                        exit();
                                    } else {
                                        echo "<div>Error deletion!</div>";
                                        echo "<i class='fa-solid fa-triangle-exclamation'></i>";
                                        header("refresh:1,url=teamreg.php");
                                    }
                                }
                            }
                            ?>
            <div class="formBtnModule <?php if (isset($_SESSION['userRoleId'])) {
                                            if ($_SESSION['userRoleId'] == 0) {
                                                echo "blockContent";
                                            } elseif ($_SESSION['userRoleId'] == 1) {
                                                echo "";
                                            }
                                        } else {
                                            echo "blockContent";
                                        } ?> ">
                <button class="fillForm fillBtn">Fill Form </button>
                <i class="fa-solid fa-scroll"></i>
            </div>
            <br>
            <div class="content <?php if (isset($_SESSION['userRoleId'])) {
                                    if ($_SESSION['userRoleId'] == 0) {
                                        echo "blockContent";
                                    } elseif ($_SESSION['userRoleId'] == 1) {
                                        echo "";
                                    }
                                } else {
                                    echo "blockContent";
                                } ?>">
                <div class="register heading">
                    <h4>Register Your Team Here</h4>
                </div>
                <?php

                ?>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo ($editRow['teamId']) ? $editRow['teamId'] : ""; ?>">
                    <div class="register">
                        <p class="labelTag">Team Name</p>
                        <input name="tname" type="text" class="form-control"
                            value="<?php echo isset($editRow) ? $editRow['teamName'] : ''; ?>" required>
                    </div>

                    <div class="register">
                        <p class="labelTag">Team Email</p>
                        <input name="temail" type="email" class="form-control"
                            value="<?php echo isset($editRow) ? $editRow['teamEmail'] : ''; ?>" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Team Phone Number</p>
                        <input name="tno" type="number" class="form-control"
                            value="<?php echo isset($editRow) ? $editRow['teamPhno'] : ''; ?>" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Upload Team Logo</p>
                        <input name='tfile' type='file' class='form-control uploadTag'>

                    </div>
                    <?php if (isset($editRow)) {
                        echo "<p>Previous logo</p> <img src='uploadfiles/" . $editRow['teamImage'] . "' alt='team logo' class='whImg'>";

                    ?>
                        <div class="register">
                            <input type="hidden" name="editId" value="<?php echo $editRow['teamId']; ?>">
                            <input name="btnSubmit" type="submit" class="btn btn-success" value="Update">
                        </div>
                    <?php } else { ?>
                        <div class="register">

                            <input name="btnSubmit" type="submit" class="btn btn-primary" value="Register">
                        </div>
                    <?php } ?>
                </form>
                <?php
                $sql = "SELECT * FROM tbl_team";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                ?>
            </div>


            <div class="feed">
                <div class="headings">
                    <h1>TEAMS</h1>
                </div>

                <div class="teamC">

                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <a href="allocate_player.php?id=<?php echo $row["teamId"]; ?>">
                            <div class="teamCa">

                                <img class="whImg" src="uploadfiles/<?php echo $row['teamImage'] ?>" alt="">
                                <div class="teamI">
                                    <?php if (isset($_SESSION['userRoleId'])) {
                                        if ($_SESSION['userRoleId'] == 0) {
                                            echo "";
                                        } elseif ($_SESSION['userRoleId'] == 1) {
                                            echo "<p>ID: " . $row["teamId"] . "</p>";
                                        }
                                    } else {
                                        echo "";
                                    } ?>

                                    <p>Name: <?php echo $row["teamName"]; ?></p>
                                    <p>Email: <?php echo $row["teamEmail"]; ?></p>
                                    <p>Created At: <?php echo date("F d, Y", strtotime($row["createdat"])); ?></p>
                                    <?php
                                    if (!isset($_SESSION['userRoleId']) || $_SESSION['userRoleId'] == 0) {

                                        echo "";
                                    } else {

                                    ?>
                                        <div class="action">
                                            <a class="btn btn-primary" href="teamreg.php?editid=<?php echo $row['teamId'] ?>">Edit Info</a>
                                            <a class="btn btn-danger" href="teamreg.php?deleteid=<?php echo $row["teamId"]; ?>">Delete</a>

                                        </div>
                                    <?php
                                    }

                                    ?>

                                </div>
                    
                </div>
                </a>
            <?php } ?>
            </div>

        <?php } ?>

        </div>


    </div>
    <div class="footer">
        <?php
        include("footer.php");
        ?>
    </div>

    </div>

    <?php
    ob_end_flush();
    ?>
    <script src="script.js"></script>
</body>

</html>