<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php include "includes/header.php";
    include_once("includes/functions.php");
    include_once("includes/database.php");?> <!-- creates the Naviation Bar-->
</body>
<div> 
    <?php
    
    if(isset($_GET["user"])){
        $userInfo = getUserInfo($_GET['user'],$conn);
        if ($userInfo){
            print_r($userInfo);
          echo '
              <div>
                <a style="font-size: 50px; font-weight: bold; padding: 20px;" class="center">'.$userInfo['username'].'</a>';
            if ($userInfo['teamID'] != 0){
                $teamInfo = getTeamInfo($conn,$userInfo['teamID']);
                if($teamInfo){
                    echo'
                    <a style="font-size: 30px;  padding: 10px; padding-bottom: 0px;" class="center">Team</a>
                    <div class="searchBar center">
                    <img src="teamLogos/',$teamInfo['teamLogo'],'" alt="Team Logo" width=40>
                    <a style="font-size: 40px; font-weight: bold;">'.$teamInfo['teamName'].'</a>
                    </div>
                    ';
                }
            }
                    echo'
                </div>';
        }
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