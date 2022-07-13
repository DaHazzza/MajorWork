<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="stylesheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<div class="tooltip" style= "position: fixed; bottom: 0; right: 0;">
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >Enter your exisitng username and password to login. If you dont have an account click register on the top right</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>

<div>
    <h1 class="center" style="margin: 20px; margin-top: 50px;">Login</h1>
    <form action="includes/loginScript.php" method="POST" class="center"> <!--once submit button pressed runs the php file and posts the data-->
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