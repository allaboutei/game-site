<?php
include_once "../config/regdbconnect.php";


if (isset($_GET['btnAssign'])) {
    $teamid = $_GET['teamId'];
    $tourid = $_GET['tourId'];

    echo "$teamid";
    echo "$tourid";

    $sql = "INSERT INTO tbl_team_allocate (id,teamId,tourId,status) VALUES (NULL,'$teamid','$tourid','0')";
    $sql1 = "UPDATE tbl_team SET assignedTour='1' WHERE teamId='$teamid' ";
    if ($conn->query($sql) == true) {

        $conn->query(($sql1));
        echo "The team is successfully assigned to this tournament";
        header("Location: ../allocate_team.php?id=$tourid");
    } else {

        echo "ERROR";
        header("Location: ../allocate_team.php?id=$tourid");
    }
}
if (isset($_GET["btnRemove"])) {
    
    $teamid = $_GET['teamId'];
    $tourid = $_GET['tourId'];
    
    // Prepare the SQL query
    $sql = "DELETE FROM tbl_team_allocate WHERE teamId='$teamid' AND tourId='$tourid'";
    $sql1="UPDATE tbl_team SET assignedTour='0' WHERE teamId='$teamid'";

   
    if ($conn->query($sql) === TRUE) {
        $conn->query($sql1);
        echo "The team is removed successfully";
        header("Location: ../allocate_team.php?id=$tourid");
    } else {
        echo "An error has occurred: " . $conn->error;
        header("Location: ../allocate_team.php?id=$tourid");
    }
}
?>
