<?php
include_once "config/regdbconnect.php";
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Allocation </title>
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
        <?php
        $resultt = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sqlt = "SELECT * FROM tbl_team WHERE teamId=$id";
            $resultt = $conn->query($sqlt);
            if (!isset($_SESSION['userId'])) {
                echo "";
            } else {
                $uid = $_SESSION['userId'];
                $sql = "SELECT * FROM tbl_captain WHERE userId=$uid AND teamId=$id";
                $result = $conn->query($sql);
                if ($row = $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $authCap = 1;
                } else {
                    $authCap = 0;
                }
                // Check if the query ran successfully
                if (!$resultt) {
                    echo "<p>Error fetching team details.</p>";
                    exit;  // Stop further execution if there's an error
                }
            }
        }
        ?>
        <div class="main">
            <div class="backButtonContainer">
                <button class="backButton" onclick="history.back()"><i class="fa-solid fa-circle-left"></i></button>
            </div>
            <div class="allocateContainer">
                <?php
                //    echo $captain_team_id;
                if ($resultt && $resultt->num_rows > 0) {
                    $rowt = $resultt->fetch_assoc();
                ?>
                    <div class="team">
                        <div class="teamL">
                            <h4 class=""><?php echo $rowt['teamName']; ?></h4>
                            <img class="whImg" src="uploadfiles/<?php echo $rowt['teamImage']; ?>" alt="Could not Load the Image">
                        </div>
                        <div class="teamR">
                            <h5>Created At: <?php echo date("l: F d, Y", strtotime($rowt["createdat"])); ?> </h5>
                            <?php $sql = "SELECT u.userName,u.userId 
                    FROM tbl_user u
                    JOIN tbl_captain c ON u.userId=c.userId
                    WHERE c.teamId='$id'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            }
                            ?>
                            <h5>Captain: <?php echo  isset($row['userName']) ? $row['userName'] : "No captain assigned"; ?></h5>
                        </div>
                    </div>
                    <hr>
                    <h5>Team Members</h5>
                    <div class="playerCard">
                        <?php
                        $sql = "SELECT tp.playerId, tp.playerName, tp.playerIgn,tp.roleId
                            FROM tbl_allocate ta 
                            JOIN tbl_player tp ON ta.playerId = tp.playerId
                            JOIN tbl_team tt ON ta.teamId = tt.teamId
                            WHERE tt.teamId = '$id'
                            AND ta.status='accepted'";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                        ?>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="playerInfo">
                                    <?php
                                    if (!isset($_SESSION['userRoleId'])) {
                                        echo "";
                                    } elseif ($_SESSION['userRoleId'] == 1 || $authCap == 1) {
                                    ?>
                                        <div class="action">
                                            <form action="allocations/player.php" method="GET">
                                                <input type="hidden" name="playerId" value="<?php echo $row['playerId']; ?>">
                                                <input type="hidden" name="teamId" value="<?php echo $id; ?>">
                                                <input class="btn btn-danger" name="btnRemove" type="submit" value="Remove">
                                            </form>
                                        </div>
                                    <?php
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                    <img src="profile/<?php echo isset($row['playerImg']) ? $row['playerImg'] : '../images/default player image.webp' ?>" alt="Image not loaded">
                                    <?php
                                    ?>
                                    <h6><?php echo $row['playerName'];  ?>

                                    </h6>
                                    <h6><?php echo $row['playerIgn']; ?></h6>
                                    <h6>
                                        <?php
                                        $rid = $row['roleId'];
                                        $sqlr = "SELECT roleName FROM tbl_role WHERE roleId='$rid'";
                                        $resultr = $conn->query($sqlr);
                                        $rowr = $resultr->fetch_assoc();
                                        echo $rowr['roleName']; ?></h6>
                                </div>
                            <?php
                            } ?>
                    </div>
            <?php
                        } else {
                            echo "<p>No player assigned to this team.</p>";
                        }
                    }
            ?>
            <hr>
            </div>
            <br>
            <div class="<?php if (!isset($_SESSION['userRoleId'])) {
                            echo "blockContent";
                        } elseif ($_SESSION['userRoleId'] == 1 || $authCap == 1) {
                            echo "allocateContainer";
                        } else {
                            echo "blockContent";
                        } ?>">
                <hr>
                <h5>Only Admins and Captains Can Allocate Players</h5>
                <h6>Current Available Players</h6>
                <?php
                $sqlp = "SELECT * FROM tbl_player WHERE status='0'";
                $resultp = $conn->query($sqlp);
                ?>
                <div class="playerCard">
                    <?php
                    if ($resultp && $resultp->num_rows > 0) {
                        while ($rowp = $resultp->fetch_assoc()) {
                    ?>
                            <div class="playerInfo">
                                <div class="action">
                                    <form action="allocations/player.php" method="GET">
                                        <input type="hidden" name="playerId" value="<?php echo $rowp['playerId']; ?>">
                                        <input type="hidden" name="teamId" value="<?php echo $id; ?>">
                                        <input class="btn btn-success" name="btnAssign" type="submit" value="Assign">
                                    </form>
                                </div>
                                <img src="profile/<?php echo isset($rowp['playerImg']) ? $rowp['playerImg'] : '../images/default player image.webp' ?>" alt="Image not loaded">
                                <h6><?php echo $rowp['playerName']; ?></h6>
                                <h6><?php echo $rowp['playerIgn']; ?></h6>
                                <h6>
                                    <?php
                                    $rid = $rowp['roleId'];
                                    $sqlr = "SELECT roleName FROM tbl_role WHERE roleId='$rid'";
                                    $resultr = $conn->query($sqlr);
                                    $rowr = $resultr->fetch_assoc();
                                    echo $rowr['roleName']; ?></h6>
                            </div>
                    <?php
                        }
                    } else {
                        echo "
                          <h6>No active players found</h6>  
                       ";
                    }
                    ?>
                </div>
            </div>
            <div class="recentMatch">
                <h3>Recent Matches</h3>
                <div class="recentCard">
                    <h4>#</h4>
                    <h4>Date</h4>
                    <h4>Tournament</h4>
                    <h4>Title</h4>
                    <h4>Format</h4>
                    <div class="recentCardScore">
                        <h4>Result</h4>
                    </div>

                    <h4>W/L/D</h4>

                </div>










                <?php $id = $rowt['teamId'];
                $number = 0;

                $sqlRecent = "SELECT 
    m.matchId AS matchId,
    m.tourId AS tourId,
    t.tourName AS tourName,
    m.matchTitle AS matchTitle,
    f.formatName AS formatName,
    m.matchDate,
    m.team1Name,
    m.team2Name,
    r.team1score,
    r.team2score,
    CASE 
        WHEN m.team1Name = $id THEN r.team1score
        WHEN m.team2Name = $id THEN r.team2score
    END AS teamScore,
    CASE 
        WHEN m.team1Name = $id THEN r.team2score
        WHEN m.team2Name = $id THEN r.team1score
    END AS opponentScore,
    CASE 
        WHEN m.team1Name = $id  THEN m.team2Name
        WHEN m.team2Name = $id  THEN m.team1Name
    END AS opponentId
FROM 
    tbl_match m
JOIN 
    tbl_result r ON m.matchId = r.matchId
JOIN tbl_tour t ON m.tourId=t.tourId
JOIN tbl_format f ON m.formatId=f.formatId
WHERE 
    m.team1Name = $id  OR m.team2Name = $id 
    AND m.status='1'
    ORDER BY m.matchId DESC";

                $resultRecent = $conn->query($sqlRecent);
                if ($resultRecent->num_rows > 0) {
                    while ($rowRecent = $resultRecent->fetch_assoc()) {
                ?>
                        <div class="recentCard">
                            <span><?php $number = $number + 1;
                                    echo $number;
                                    ?></span>
                            <span><?php
                                    echo $rowRecent['matchDate'];
                                    ?></span>
                            <span>
                                <?php
                                echo $rowRecent['tourName'];
                                ?>
                            </span>
                            <span><?php
                                    echo $rowRecent['matchTitle'];
                                    ?></span>
                            <span><?php
                                    echo $rowRecent['formatName'];
                                    ?></span>

                            <div class="recentCardScore">

                                <?php
                                $teamscore = $rowRecent['teamScore'];
                                $opponentscore = $rowRecent['opponentScore'];

                                echo $teamscore . "  :  " . $opponentscore;


                                $opponentid = $rowRecent['opponentId'];
                                $sql = "SELECT teamImage FROM tbl_team WHERE teamId= '$opponentid'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();

                                ?>
                                <a href="allocate_player.php?id=<?php echo $opponentid; ?>"><img class="wh70" src="uploadfiles/<?php echo $row['teamImage'] ?>" alt=""></a>
                            </div>

                            <span>
                                <?php
                                if ($teamscore > $opponentscore) {

                                    echo "WIN";
                                } elseif ($teamscore == $opponentscore) {
                                    echo "DRAW";
                                } else {
                                    echo "LOSS";
                                }

                                ?>
                            </span>


                        </div>
                <?php
                    }
                } else {
                    echo "<h6>No recent matches found</h6>";
                }


                ?>


            </div>
            <br><br>
        </div>
        <div class="footer">
            <?php include("footer.php"); ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>