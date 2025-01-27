<?php $currentPage = 'profile';
include_once "config/regdbconnect.php";
session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cf47e7251d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php include("header.php"); ?>
        </div>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_user WHERE userId='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $uid = $row['userId'];
        }
        if (isset($_POST['btnAccept'])) {
            $pid = $_POST['playerId'];
            $uid = $_POST['userId'];
            $aid = $_POST['allocateId'];
            $sql1 = "UPDATE tbl_allocate SET status='accepted',joinedat=NOW() WHERE playerId='$pid' AND id='$aid' ";
            $result1 = $conn->query($sql1);
            $sql2 = "UPDATE tbl_player SET status ='1' WHERE playerId='$pid'";
            $conn->query($sql2);
            echo "<div class='loader mg0Auto'></div>";
            echo "<h3 class='noti'>Successfully Joined</h3>";
            header("location:profile.php?id=" . $uid);
            exit();
        }
        if (isset($_POST['btnReject'])) {
            $pid = $_POST['playerId'];
            $uid = $_POST['userId'];
            $aid = $_POST['allocateId'];
            $sql1 = "DELETE FROM tbl_allocate
             WHERE playerId='$pid' AND id='$aid' ";
            $result1 = $conn->query($sql1);
            $sql2 = "UPDATE tbl_player SET status  ='0' WHERE playerId='$pid'";
            $conn->query($sql2);
            echo "<div class='loader mg0Auto'></div>";
            echo "<h3 class='noti'>Rejected</h3>";
            header("location:profile.php?id=" . $uid);
            exit();
        }
        ?>
        <div class="main">
            <div class="profileContainer">
                <h3>Welcome Back, <?php echo $row['userName'] ?></h3>
                <div class="profileInfo">
                    <div class="profileCard">
                        <h5 class="mg0Auto">User Perspective</h5>
                        <div class="Info">
                            <p>User Name : <?php echo $row['userName'] ?></p>
                        </div>
                        <div class="Info">
                            <p>User Email : <?php echo $row['userEmail'] ?></p>
                        </div>
                        <div class="Info">
                            <p>Created : <?php echo date("F d, Y", strtotime($row["createdat"]))  ?></p>
                        </div>
                    </div>
                    <div class="profileCard">
                        <h5 class="mg0Auto">Player Perspective</h5>
                        <?php
                        $sql = "SELECT tp.playerId,tp.playerIgn,tp.roleId FROM tbl_player tp JOIN tbl_user tu ON tp.userId = tu.userId WHERE tp.userId = '$id'";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            if (isset($row['playerId'])) {
                                $playerid = $row['playerId'];
                                $sql1 = "SELECT tt.teamName FROM tbl_allocate ta JOIN tbl_team tt ON ta.teamId = tt.teamId WHERE ta.playerId = '$playerid' AND ta.status='accepted'";
                                $result1 = $conn->query($sql1);
                                if ($result1 && $result1->num_rows > 0) {
                                    $row1 = $result1->fetch_assoc();
                                }
                            }
                        }
                        ?>
                        <div class="Info">
                            <p>Gaming Name : <?php echo isset($row['playerIgn']) ? $row['playerIgn'] : "You Haven't Registered As A Player" ?></p>
                        </div>
                        <div class="Info">
                            <?php
                            if (isset($row['roleId'])) {
                                $roleid = $row['roleId'];
                                $sqlr = "SELECT roleName FROM tbl_role WHERE roleId='$roleid'";
                                $resultr = $conn->query($sqlr);
                                $rowr = $resultr->fetch_assoc();
                            } ?>
                            <p>In Game Role : <?php echo isset($rowr['roleName']) ? $rowr['roleName'] : "You Haven't Registered As A Player" ?></p>
                        </div>
                        <div class="Info">
                            <p>Current Team : <?php echo isset($row1['teamName']) ? $row1['teamName'] : "Not In A Team" ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="playerStatus">

                <h3>Pending Team Invitations</h3>
                <?php
                if (isset($playerid)) {
                    $sql = "SELECT * FROM tbl_allocate ta JOIN tbl_player tp ON ta.playerId=tp.playerId WHERE ta.playerId='$playerid' AND ta.status='pending'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $tid = $row['teamId'];
                ?>
                        <h4> From : <?php
                                    $sql1 = "SELECT teamName FROM tbl_team WHERE teamId='$tid'";
                                    $result1 = $conn->query($sql1);
                                    $row1 = $result1->fetch_assoc();
                                    echo $row1['teamName']; ?></h4>
                        <h4>Invited At : <?php echo date("g:i A l: F d, Y", strtotime($row["joinedat"])); ?></h4>
                        <form action="#" method="POST">
                            <input type="hidden" name="playerId" value="<?php echo $row['playerId']; ?>">
                            <input type="hidden" name="allocateId" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="userId" value="<?php echo $uid ?>">
                            <input class="btn btn-success" type="submit" name="btnAccept" value="Accept">
                            <input class="btn btn-danger" type="submit" name="btnReject" value="Reject">
                        </form>
                <?php
                    } else {
                        echo "There Is No Pending Invitations";
                    }
                } else {
                    echo "There Is No Pending Invitations";
                }
                ?>
            </div>
        </div>
        <br>
        <div class="footer">
            <?php include("footer.php"); ?>
        </div>
</body>

</html>