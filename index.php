<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php


 include "includes/header.php";

    ?> <!-- creates the Naviation Bar-->
</body>
<?php
print_r(getMatchInfo(1,$conn));
