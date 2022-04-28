<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php


 include "includes/header.php";
    include "includes/functions.php";
    include "includes/database.php";
    ?> <!-- creates the Naviation Bar-->
</body>
<?php
if(isset($_SESSION['username'])){
        $data =  $_SESSION["username"] ;
        echo($data);}
    echo gettype(GetPlayerNamesFromTeamID($conn,"2"));


    
?>
