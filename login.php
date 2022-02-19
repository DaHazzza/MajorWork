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
include_once "includes/database.php";
?> <!-- connects to the database -->

<div>
    <header>Login</header>
    <form action="includes/loginScript.php" method="POST"> <!--once submit button pressed runs the php file and posts the data-->
            <input type="text" name="Username" placeholder="Username:">
            <br>
            <input type="password" name="Pass" placeholder="Password:">
            <br>
            <button type="submit" name="submit">Login</button>
    </form>
    <?php 
        if (isset($_GET["login"])){
            $msg = $_GET["login"];
            if ($msg == "empty"){
                echo "<p class='error'>You Did Not Fill Out All The Feilds</p>";
            }
            if ($msg == "invalid"){
                echo "<p class='error'>The Username Or Password Was Incorrect</p>";
            }

        }
    ?>
</div>