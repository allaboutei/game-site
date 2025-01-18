<!DOCTYPE html>
<html lang="en">
<?php
include_once "config/regdbconnect.php";
ob_start();
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Allocations</title>
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
            if (isset($_GET['id'])) {
                $tourid = $_GET['id'];
                $sql = "SELECT * FROM tbl_tour WHERE tourId='$tourid'";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    echo "No tournament found.";
                    exit;
                }
            }
            ?>
            <div class="allocate_team">
                <h5><?php echo $row['tourName'] ?></h5>
                <p><strong>Location : &nbsp;</strong><?php echo $row['tourLocation']  ?></p>
                <p><strong>From&nbsp;</strong><?php echo date("M d, Y", strtotime($row['tourStartDate'])); ?>&nbsp;-&nbsp;<strong>To&nbsp;</strong><?php echo date("M d, Y", strtotime($row['tourEndDate'])); ?></p>
                <img src="uploadfiles/tourimages<?php echo $row['tourImage']  ?>" alt="Image not found" style="display:flex; width: 100%; height: 400px; margin: 0 auto;">


            </div>
            <p style="text-indent: 50px;margin:0px 100px" ><?php echo $row['tourDesc'] ?></p>
            <hr>
            <h4>Invited Teams</h4>
            <div style="margin: 0 auto; display: flex; justify-content: center;">

                <?php
                $sql1 = "SELECT tm.teamId,tm.teamName,tm.teamImage
                    FROM tbl_team tm LEFT JOIN tbl_team_allocate  ta ON tm.teamId=ta.teamId       
                    WHERE ta.tourId='$tourid' ";

                $result1 = $conn->query($sql1);
                if ($result1 && $result1->num_rows > 0) {
                ?>


                    <div class="teamC">


                        <?php
                        while ($row1 = $result1->fetch_assoc()) {

                        ?>
                            <div class="teamCa txtb">

                                <img style="margin:0px 40px" class="whImg" src="uploadfiles/<?php echo $row1['teamImage']; ?>" alt="">
                                <?php echo $row1['teamName']; ?>

                                <div class="teamI">

                                    <?php
                                    if (isset($row1['teamId'])) {
                                        $teamid = $row1['teamId'];
                                        $sql3 = "SELECT tp.* FROM tbl_player tp
                                                    LEFT JOIN tbl_allocate ta ON tp.playerId=ta.playerId
                                                    WHERE teamId='$teamid'";
                                        $result3 = $conn->query($sql3);
                                        if ($result3 && $result3->num_rows > 0) {
                                            while ($row3 = $result3->fetch_assoc()) {
                                                echo $row3['playerName'] . "<br>";
                                            }
                                        }
                                    } else {
                                        echo "No Players Assigned";
                                    }

                                    ?>
                                    <div class="action">
                                        <?php if (!isset($_SESSION['userRoleId']) || $_SESSION['userRoleId'] == 0) {

                                            echo "";
                                        } else {
                                        ?>

                                            <form action="allocations/team.php" method="GET">
                                                <input type="hidden" name="teamId" value="<?php echo $row1['teamId']; ?>">
                                                <input type="hidden" name="tourId" value="<?php echo $tourid; ?>">
                                                <input class="btn btn-danger" name="btnRemove" type="submit" value="Remove">
                                            </form>

                                        <?php
                                        } ?>
                                    </div>
                                </div>









                            </div>
                        <?php
                        }
                        ?>
                    </div>

                <?php
                } else {
                    echo "No Team Assigned";
                }
                ?>
            </div>

            <div class=" <?php if (!isset($_SESSION['userRoleId']) || $_SESSION['userRoleId'] == 0) {

                                echo "blockContent";
                            } else {
                                echo "";
                            } ?>">
                <hr>
                <br>
                <h4>Available Teams</h4>
                <div style="margin: 0 auto; display: flex; justify-content: center;">
                    <?php

                    $sql2 = "SELECT tm.teamId,tm.teamName,tm.teamImage FROM tbl_team tm 
                    LEFT JOIN tbl_team_allocate ta ON tm.teamId=ta.teamId AND ta.tourId='$tourid' WHERE ta.teamId IS NULL";

                    $result2 = $conn->query($sql2);
                    if ($result2 && $result2->num_rows > 0) {
                    ?>
                        <div class="teamC">
                            <?php
                            while ($row2 = $result2->fetch_assoc()) {
                            ?>
                                <div class="teamCa txtb">

                                    <img style="margin:0px 40px" class="whImg" src="uploadfiles/<?php echo $row2['teamImage']; ?>" alt="">
                                    <?php echo $row2['teamName']; ?>

                                    <div class="teamI">

                                        <?php
                                        if (isset($row2['teamId'])) {
                                            $teamid = $row2['teamId'];
                                            $sql3 = "SELECT tp.* FROM tbl_player tp
                                                   LEFT JOIN tbl_allocate ta ON tp.playerId=ta.playerId
                                                   WHERE teamId='$teamid'";
                                            $result3 = $conn->query($sql3);
                                            if ($result3 && $result3->num_rows > 0) {
                                                while ($row3 = $result3->fetch_assoc()) {
                                                    echo $row3['playerName'] . "<br>";
                                                }
                                            }
                                        } else {
                                            echo "No Players Assigned";
                                        }

                                        ?>
                                        <div class="action">
                                            <?php if (!isset($_SESSION['userRoleId']) || $_SESSION['userRoleId'] == 0) {

                                                echo "";
                                            } else {
                                            ?>

                                                <form action="allocations/team.php" method="GET">
                                                    <input type="hidden" name="teamId" value="<?php echo $row2['teamId']; ?>">
                                                    <input type="hidden" name="tourId" value="<?php echo $tourid; ?>">
                                                    <input class="btn btn-success" name="btnAssign" type="submit" value="Assign">
                                                </form>


                                            <?php
                                            } ?>
                                        </div>
                                    </div>









                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    } else {
                        echo "No Available Teams";
                    }
                    ?>
                </div>
            </div>

        </div>
        <br>
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