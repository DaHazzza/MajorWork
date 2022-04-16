<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php


 include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<?php
include_once("includes/functions.php");
include_once("includes/database.php");
$info;
if (isset($_GET['id']) && $_GET['id'] != ""){
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
            ';
            foreach (GetPlayerNamesFromTeamID($conn, $_GET['id']) as $j => $i){
                echo '<li class="teamPlrLi"> <a class="teamPlrLiA"';if($j == $info["captinID"]){echo'style="text-decoration: underline;"';} echo' href="profilePage.php?user=',$j,'">',$i,'</a></li>';
            }
            echo '
        </ul>
    </div>
    <div style="position: absolute; margin-top: 15%;">
        <table>
        <tbody>
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
        </tbody>
        </table>'
    ;
    ?>
    <a style="font-size: xx-large; font-weight: bold; ">Past Matches</a>
    currently only match ids, need to get match info once match frameowrk done
    <table>
    <?php foreach(csvToArr($info['previousMatchIds'])as $i){
        echo '            
        <tr>
            <td>',$i,'</td>

        </tr>';
    } ?>
            


    </table>

    <?php
if (isset($_SESSION["username"]) and $_SESSION["userID"] ==$info ['captinID'] ){
    //if logged in user if the team captin 
    echo'
    <a style="font-size: xx-large; font-weight: bold; ">Captin Actions</a>
    <form action="includes/upload.php" method="post" enctype="multipart/form-data">
    Upload New Team Logo:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    <input type="hidden" name="teamID" value="',$info["teamID"],'" />
  </form>
  <form action="includes/renameTeamScript.php" method="post">
  Rename Team:
  <input type="text" name="name" id="name">
  <input type="submit" value="Submit" name="submit">
  <input type="hidden" name="teamID" value="',$info["teamID"],'" />
</form>';
}
echo"</div></div>";
}else{
    header("Location: teams.php");
    exit;
}
}else{
    header("Location: teams.php");
    exit;
} 




?> 


