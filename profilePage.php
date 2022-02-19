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
    <?php
    if(isset($_GET["user"])){
        //create user page for user ing _GET['user']

    }else{
    echo($_SESSION["userID"]);
    echo("</br>");
    echo($_SESSION["username"]);
    echo("</br>");
    echo($_SESSION["sub"]);
    echo("</br>");
    echo($_SESSION["teamID"]);
    }
    ?>


<form action="includes/logout.php">
    <input type="submit" name="Logout" value="Logout"/>
</form>
</div>