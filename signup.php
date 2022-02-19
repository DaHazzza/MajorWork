<?php 
include_once "includes/database.php";
?> <!-- connects to the database -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>
<div>
    <header>Create An Account</header>
    <form action="includes/signUpScript.php" method="POST"> <!--once submit button pressed runs the php file and posts the data-->
            <input type="text" name="Username" placeholder="Username:">
            <br>
            <input type="password" name="Pass" placeholder="Password:">
            <br>
            <input type="password" name="confirmPass" placeholder="Confirm Password:">
            <br>
            <button type="submit" name="submit">Sign Up</button>
    </form>
    <?php 
        if (isset($_GET["signup"])){
            $msg = $_GET["signup"];
            if ($msg == "empty"){
                echo "<p class='error'>You Did Not Fill Out All The Feilds</p>";
            }
            if ($msg == "exists"){
                echo "<p class='error'>Username Already Exists</p>";
            }
            if ($msg == "confirm"){
                echo "<p class='error'>Passwords Do Not Match</p>";
            }
            if ($msg == "sqlerr"){
                echo "<p class='error'>SQL Error</p>";
            }
            if ($msg == "success"){
                echo "<p class='success'>Success!</p>";
            }
        }
    ?>
</div>