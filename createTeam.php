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

if(isset($_SESSION["username"]) == False){
    header('Location: index.php');
    exit;
}
?> <!-- connects to the database -->
<div>
  <h1 class="center" style="margin-top: 70px;">Create A Team</h1>
  <br>
  <form class="center" method="POST" action="includes/createTeamScript.php">
    <label for='teamName' style="padding: 20px;">Team Name: </label><br />
    <input type="text" name="teamName"> 
    <input type="hidden" name="uid" value=<?php echo $_SESSION['userID']; ?>>
    <input type="submit" value="Create" name="submit">
</form>
</div>