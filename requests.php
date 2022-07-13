<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="stylesheet.css">

<div class="tooltip" style= "position: fixed; bottom: 0; right: 0;">
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >As a team captin anyone who requests to join your team will show up here</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>

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

        if(isset($_GET['state'])){
            if($_GET['state'] == 'validationErr'){
                echo '<a class="error center" > Validation Error</a>';
            }elseif($_GET['state'] == 'requestErr'){
                echo '<a class="error center" > Invalid Request</a>';
            }
        }

        $sql = "SELECT * FROM joinrequests WHERE teamId = ".$_SESSION['teamID']; 
        
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result)) {
                    $user = getUserInfo($row[2],$conn);
                    echo '<div class="center"><a style="font-weight: bold; font-size: 30px; color: black; text-decoration: none;" href="profilePage.php?user='.$row[2].'">'.$user['username'].'</a> 
                    <a href="includes/accReq.php?reqID='.$row[0].'"><img src="images/tick.jpg" alt="Accept request" width=42 style="margin-top: 3px;"></a>
                    <a href="includes/denReq.php?reqID='.$row[0].'"><img src="images/cross.png" alt="Accept request" width=30></a> </div>
                    </br>';
                }
            }else{
                echo '<a class="error center" > No Join Requests </a>';
            }
        }
    }
}

