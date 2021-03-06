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
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >Enter a team Name in the feild to create a team</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>

<?php 


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
<?php   
if (isset($_GET['state'])){
    switch($_GET['state']){
        case 'success':
            echo "<p class='success center'>Successfully created Team</p>";
            break;
        case 'inTeam':
            echo "<p class='error center'>You are Already In a Team</p>";
            break;
        case 'nameErr':
            echo "<p class='error center'>Invalid Team Name Must be < 32 chars</p>";
            break;
        case 'passErr':
            echo "<p class='error center' >Pass Error</p>";
            break;
    }
}

?>
</div>