<?php 
session_start();
include 'database.php';

if (isset($_SESSION["userID"])){
    $uid = $_SESSION["userID"];
    $sql = "UPDATE users SET isSubstitute = 1 WHERE id='$uid'";
    mysqli_query($conn,$sql);
    header("location: ../Substitute.php?state=confirmReg");
} else {

    header("location: ../Substitute.php?state=loginerr");
}
