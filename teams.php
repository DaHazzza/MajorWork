<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>



<h1 class="center" style="margin: 5px; margin-top:70px;">Search Teams</h1>
<div class="searchBar center">
  

    <form action="teams.php"  class="searchForm">
      <input type="text" placeholder="Search.." name="search" style="font-size: x-large;">
      <button type="submit" class="searchButton">X</button>
    </form>
</div>

<div class="center">
<table>
  <tr>
    <th>Rank</th>
    <th>Logo</th>
    <th>TeamName</th>
    <th>Wins</th>
    <th>losses</th>
  </tr>




<?php 

$sql;
if (isset($_GET['search'])){
 $sql =  "SELECT * FROM teams ORDER BY rank WHERE teamName LIKE '%".$_GET['search']."%'";
} else {
$sql = "SELECT * FROM teams  ORDER BY rank";}

if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
    if ($row[9] == 0){
      echo '<tr> <td>';
      echo $row[8];
      echo '</td> <td>';
      echo  '<img src="teamLogos/',$row[2],'" alt="Team Logo" width=40>';
      echo '</td> <td>';
      echo  "<a href='teamPage.php?id=",$row[0],"'>" .$row[1].'</a>';
      echo '</td> <td>';
      echo  $row[5] ;
      echo '</td> <td>';
      echo  $row[6] ;
      echo '</td>  </tr>';
    }
  }
}
?>