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

<h1 class="center" style="margin: 5px; margin-top: 60px;">Upcoming Matches</h1>

<div class="center">
<table style="width: 30%;" >
  <tr style="background-color: rgb(220,220,220);">
    <th >Team 1</th>
    <th > </th>
    <th >Vs</th>
    <th > </th>
    <th >Team 2</th>
    <th >Time</th>
    <th >Match Page</th>
  </tr>


<?php 

$sql = "SELECT * FROM matches"; 

if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
      if($row[8] == 0){
            $team1Info = getTeamInfo($conn, $row[1]);
            $team2Info = getTeamInfo($conn, $row[2]);
            echo '<tr style="background-color: rgb(240,240,240);"> <td>';
            echo "<a  class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$row[1]."'>  " .$team1Info['teamName'].'  </a>';
            echo '</td> <td>';
            echo  '<a class="center"><img src="teamLogos/'.$team1Info["teamLogo"].'" alt="Team Logo" width=40></a>';
            echo '</td> <td>';
            echo "<a class='center' style='color: black; text-decoration: none;' href='matchPage.php?id=".$row[0]."'>VS</a>" ;
            echo '</td> <td >';
            echo  '<a class="center"><img class="center" src="teamLogos/'.$team2Info["teamLogo"].'" alt="Team Logo" width=40></a>';
            echo '</td> <td >';
            echo "<a class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$row[2]."'>  " .$team2Info['teamName'].'  </a>';
            echo '</td> <td>';
            if ($row[3] != null){
                echo '<a class="center">'.date("M d Y H:i",$row[3] +( 3600*8)).'</a>';
            }else{
                echo'<a class="center">N/A </a>';
            }
                echo '</td> <td >';     
                echo  '<a href="matchPage.php?id='.$row[0].'"><img src="images/matchLink.png" alt="Match Link" width=40 style="margin-left: 40%;"></a>';
                echo '</td>  </tr>';
        }
    }
  }
?>
</div>
<a style='color: black; text-decoration: none;'>