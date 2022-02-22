<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<?php
include_once("includes/functions.php");
include_once("includes/database.php");
$info;
if (isset($_GET['id'])){
    $info = getTeamInfo($conn,$_GET['id']);
    if  ($info != False){
    echo '
   <!--i know im bad at css -->
<div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;" >
    <div style="width: 30%; margin: 0; position:absolute">
        <a style="font-size: xx-large; font-weight: bold; ">'.$info['teamName'].'</a>
        <a style="font-size: large; padding-left: 10px;">#'.$info['rank'].'</a>
        <br>
        <img src="teamLogos/'.$info['teamLogo'].'" alt="Team Logo" style="border-width: 5px; border-style: solid;
        border-color: Black; border-radius: 10px;">
    </div>
    <div style="position: absolute; margin-left: 15%; margin-top:5%;"  >
        <ul style="list-style-type:none">
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
            <li class="teamPlrLi"> <a class="teamPlrLiA" href="users.php">Player1</a></li>
        </ul>
    </div>
    <div style="position: absolute; margin-top: 15%;">
        <table>
        <tr >
            <th class="teamStatsTH">Games Played</th>
            <th class="teamStatsTH">Wins</th>
            <th class="teamStatsTH">Losses</th>
            <th class="teamStatsTH">Total Points Scored</th>
        </tr>
        <tr>
            <th>'. strval( $info['wins']+$info['losses']).'</th>
            <th>'.$info['wins'].'</th>
            <th>'.$info['losses'].'</th>
            <th>'.$info['pointsScored'].'</th>
        </tr>
    </div>
    <a>TODO ADD PREV MATCHES</a>
</div>
';}else{
    header("Location: teams.php");
    exit;
}
}else{
    header("Location: teams.php");
    exit;
} 

$tesr =GetPlayerNamesFromTeamID(  $conn, $_GET['id']);
print_r( $tesr);
//currently this func only returns 1 player, TODO make it return all players and also work out what to do if only 4 players are in a team
?> 