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
getTeamInfo($conn,1);
if (isset($_GET['id'])){

}