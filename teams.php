<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="stylesheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<div class="tooltip" style= "position: fixed; bottom: 0; right: 0;">
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >A list of all the teams click their names to go to their team page. use the searchbar to search for teams</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>

<h1 class="center" style="margin: 5px; margin-top:70px;">Search Teams</h1>
<div class="searchBar center">
  

    <form action="teams.php"  class="searchForm">
      <input type="text" placeholder="Search.." name="search" style="font-size: x-large;">
      <button type="submit" class="searchButton">X</button>
    </form>
</div>

<div class="center">
<table>
  <tr  style="background-color: rgb(220,220,220);">
    <th>Score</th>
    <th>Logo</th>
    <th>TeamName</th>
    <th>Wins</th>
    <th>losses</th>
  </tr>




<?php 

$sql;
if (isset($_GET['search'])){
 $sql =  "SELECT * FROM teams WHERE teamName LIKE '%".$_GET['search']."%' ORDER BY score DESC ";
} else {
$sql = "SELECT * FROM teams  ORDER BY score DESC";}

if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
    if ($row[9] == 0){
      echo '<tr  style="background-color: rgb(240,240,240);"> <td>';
      echo '<a class="center">'.$row[8].'</a>';
      echo '</td> <td>';
      echo  '<img src="teamLogos/',$row[2],'" alt="Team Logo" width=40 class="center">';
      echo '</td> <td>';
      echo  "<a class='center remHref' href='teamPage.php?id=",$row[0],"'>" .$row[1].'</a>';
      echo '</td> <td>';
      echo  '<a class="center">'.$row[5].'</a>';
      echo '</td> <td>';
      echo  '<a class="center">'.$row[6].'</a>';
      echo '</td>  </tr>';
    }
  }
}
?>