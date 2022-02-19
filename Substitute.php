<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>

<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php

use function PHPSTORM_META\type;

include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<?php 
if (isset($_SESSION["userID"])){
  include 'includes/registerSubButtons.php';
}
?>

<h1 class="center" style="margin: 5px;">Search Players</h1>
<div class="searchBar center">
  

    <form action="Substitute.php"  class="searchForm">
      <input type="text" placeholder="Search.." name="search" style="font-size: x-large;">
      <button type="submit" class="searchButton">X</button>
    </form>
</div>

<div class="center">
<table>
  <tr>
    <th>Username</th>
    <th>Is Sub</th>
    <th>TeamID</th>
  </tr>




<?php 
include 'includes/database.php';

$sql;
if (isset($_GET['search'])){
 $sql =  "SELECT * FROM users WHERE username LIKE '%".$_GET['search']."%'";
} else {
$sql = "SELECT * FROM users";}

if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_array($result)) {
    $subvalue;
    if ($row[3] == 0){
      $subvalue = "false";
    }else{
      $subvalue = "true";
    }

     echo '<tr> <td>';
      echo "<a href='test.com'>" .$row[1].'</a>';
      echo '</td> <td>';
      echo  $subvalue;
      echo '</td> <td>';
      echo  $row[4] ;
      echo '</td>  </tr>';
    }
  }
?>
</div>