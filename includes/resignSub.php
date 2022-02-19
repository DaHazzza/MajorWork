<?php 
session_start();
include 'database.php';

if (isset($_SESSION["userID"])){
    $uid = $_SESSION["userID"];
    $sql = "UPDATE users SET isSubstitute = 0 WHERE id='$uid'";
    mysqli_query($conn,$sql);
    header("location: ../Substitute.php?state=confirmRes");
} else {

    header("location: ../Substitute.php?state=loginerr");
}
