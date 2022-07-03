<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="stylesheet.css">

<body style="margin:0%;"> 
    <?php


 include "includes/header.php";

    ?> <!-- creates the Naviation Bar-->
</body>
<?php

if(isset($_SESSION['userID']) and $_SESSION['teamID'] != 0){
    
    $teamInfo = getTeamInfo($conn, $_SESSION['teamID']);
    if($teamInfo and $_SESSION['userID'] == $teamInfo['captinID']){
        echo '<h1 class="center" style="margin: 5px; margin-top: 50px;">Join Requests</h1>
        <div class=" center">
        </div>';

        $sql = "SELECT * FROM joinrequests WHERE teamId = ".$_SESSION['teamID']; 
        
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $user = getUserInfo($row[2],$conn);
                echo $user['username']."</br>";
            }
        }
    }
}

