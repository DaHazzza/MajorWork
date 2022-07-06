<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>

<link rel="stylesheet" href="stylesheet.css">
<body style="margin:0%;"> 
<?php
include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<h1 class="center" style="margin: 5px;">Search Players</h1>
<div class="searchBar center">
  

    <form action="Players.php"  class="searchForm">
      <input type="text" placeholder="Search.." name="search" style="font-size: x-large;">
      <button type="submit" class="searchButton">X</button>
    </form>
</div>

<div class="center">
<table>
  <tr>
    <th style="background-color: rgb(220,220,220);">Username</th>
    <th style="background-color: rgb(220,220,220);">TeamID</th>
  </tr>




<?php 


$sql;
if (isset($_GET['search'])){
 $sql =  "SELECT * FROM users WHERE username LIKE '%".$_GET['search']."%'";
} else {
$sql = "SELECT * FROM users";}

if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
     echo '<tr style="background-color: rgb(240,240,240);"> <td>';
      echo "<a class= 'center' style =' color: black; text-decoration: none;' href='profilePage.php?user=".$row[0]."'>" .$row[1].'</a>';
      echo '</td> <td>';
      if ($row[3] == 0){
        echo '<a class="center">No Team</a>';
      }else{
        echo  '<a class="center" style =" color: black; text-decoration: none;" href="teamPage.php?id='.$row[3].'">'. getTeamInfo($conn,$row[3])['teamName']."</a>";
      }
      echo '</td>  </tr>';
    }        
  }
?>
</div>