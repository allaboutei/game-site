<?php
$currentPage = 'newsletter';
include_once("config/regdbconnect.php");
session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Sentry</title>
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
        <div class="main">
            <?php
            if (isset($_POST["btnUpload"])) {

                $newshead = htmlspecialchars($_POST["nheading"]);
                $newsbody = htmlspecialchars($_POST["nbody"]);

                if (isset($_FILES["nfile"]) && $_FILES["nfile"]["error"] == 0) {
                    $filename = $_FILES["nfile"]["name"];
                    $filepatch = $_FILES["nfile"]["tmp_name"];
                } else {
                    $filename = "";
                }
                $sql = "INSERT INTO tbl_news(newsId,newsHeading,newsBody,newsFootage) VALUES (NULL,'$newshead','$newsbody','$filename')";
                if ($conn->query($sql) == True) {
                    echo "News Inserted Successfully";
                    move_uploaded_file($filepatch, "uploadfiles/" . $filename);
                    header("location:newsletter.php");
                    exit();
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
                    <h4>Upload the news</h4>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="register">
                        <label for="exampleFormControlInput1" class="labelTag">News Heading</label>
                        <input name="nheading" type="text" class="form-control" id="" placeholder="">
                    </div>
                    <div class="register">
                        <label for="" class="labelTag">News Body</label>
                        <input name="nbody" type="text" class="form-control" id="" placeholder="">
                    </div>
                    <div class="register">
                        <label class="labelTag">Upload News Footage</label>
                        <input name="nfile" type="file" class="form-control uploadTag">
                    </div>
                    <div class="register">
                        <input name="btnUpload" class="btn btn-primary" type="submit" value="Upload News">
                    </div>
                </form>

            </div>

            <div class="feed">

                <div class="newsContainer">
                    <div class="headings">
                        <h1>NEWS</h1>
                    </div>
                    <?php

                    $sql = "SELECT * FROM tbl_news";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <div id="" class="newsCard">
                                <a href="<?php echo './newsdetails.php?id=' . $row["newsId"] ?>">

                                    <img class="newsImg" src="uploadfiles/<?php echo $row["newsFootage"] ?>"
                                        alt="Cannot Load Image">
                                    <div class="newsDetail">
                                        <h5> <?php echo date("F d (D), Y", strtotime($row["newsDate"])); ?> </h5>
                                        <h4> <?php echo $row["newsHeading"] ?> </h4>
                                        <p><?php echo $row["newsBody"] ?></p>
                                    </div>

                                </a>
                            </div>
                        <?php } ?>
                </div>


            </div>

        <?php
                    } else {
                        echo "<div class='newsContainer'>
                <h4 style='color:black;'>No News Available</h4>
            </div>";
                    }
        ?>
        <br>
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