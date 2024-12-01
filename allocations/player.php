<?php
include_once "../config/regdbconnect.php";
if (isset($_GET["btnAssign"])) {

    $playerId = $_GET['playerId'];
    $teamId = $_GET['teamId'];


    $sql = "INSERT INTO tbl_allocate (id, playerId, teamId,status) VALUES (NULL, '$playerId', '$teamId','pending')";
    $sql1 = "UPDATE tbl_player SET status='1' WHERE playerId='$playerId'";

    if ($conn->query($sql) === TRUE) {
        $conn->query($sql1);
        echo "Player is assigned successfully";
        header("Location: ../allocate_player.php?id=$teamId");
    } else {
        echo "An error has occurred: " . $conn->error;
        header("Location: ../allocate_player.phpid=$teamId");
    }
}
if (isset($_GET["btnRemove"])) {

    $playerId = $_GET['playerId'];
    $teamId = $_GET['teamId'];

    // Prepare the SQL query
    $sql = "DELETE FROM tbl_allocate WHERE playerId='$playerId' AND teamId='$teamId'";
    $sql1 = "UPDATE tbl_player SET status='0' WHERE playerId='$playerId'";

    if ($conn->query($sql) === TRUE) {
        $conn->query($sql1);
        echo "Player is assigned successfully";
        header("Location: ../allocate_player.php?id=$teamId");
    } else {
        echo "An error has occurred: " . $conn->error;
        header("Location: ../allocate_player.phpid=$teamId");
    }
}
