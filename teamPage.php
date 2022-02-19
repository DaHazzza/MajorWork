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
    echo '';
    
} 

?>
<div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;" >
<a style="font-size: xx-large; font-weight: bold; ">TeamName</a>
<a style="font-size: large; padding-left: 10px;">#1</a>
<br>
<img src="teamLogos/default.png" alt="Team Logo" style="border-width: 5px; border-style: solid;
  border-color: Black; border-radius: 10px;">
<!--Create list of players -->
</div>

