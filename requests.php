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
        echo '<h1 class="center" style="margin: 5px; margin: 50px;">Join Requests</h1>
        <div class=" center">
        </div>';

        $sql = "SELECT * FROM joinrequests WHERE teamId = ".$_SESSION['teamID']; 
        
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $user = getUserInfo($row[2],$conn);
                echo '<dic class="center"><a style="font-weight: bold; font-size: 30px; color: black; text-decoration: none;" href="profilePage.php?user='.$row[2].'">'.$user['username'].'</a> 
                <a href="includes/accReq.php?reqID='.$row[0].'"><img src="images/tick.jpg" alt="Accept request" width=42 style="margin-top: 3px;"></a>
                <a href="includes/denReq.php?reqID='.$row[0].'"><img src="images/cross.png" alt="Accept request" width=30></a>
                </br>';
            }
        }
    }
}

