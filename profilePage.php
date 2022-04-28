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
        $userInfo = getUserInfo($_GET['user'],$conn);}
    elseif(isset($_SESSION['userID'])){
        $userInfo = getUserInfo($_SESSION['userID'],$conn);
    }else{
        $userInfo = false;
    }
    if ($userInfo){
        echo '
            <div>
            <a style="font-size: 50px; font-weight: bold; padding: 20px;" class="center">'.$userInfo['username'].'</a>';
        if ($userInfo['teamID'] != 0){
            $teamInfo = getTeamInfo($conn,$userInfo['teamID']);
            if($teamInfo){
                echo'
                <a style="font-size: 30px;  padding: 10px; padding-bottom: 0px;" class="center">Team</a>
                <div class="searchBar center">
                <img src="teamLogos/'.$teamInfo['teamLogo'].'" alt="Team Logo" width=40>
                <a style="font-size: 40px; font-weight: bold; text-decoration: none; color: black;" href="teamPage.php?id='.$teamInfo["teamID"].'">'.$teamInfo['teamName'].'</a>
                <a style="font-size: large; padding-left: 10px;">#'.$teamInfo['rank'].'</a>
                </div>
                ';
            }
        }
                echo'
            </div>';
    }else{
        header('Location: index.php');
        exit;}
    ?>


<form action="includes/logout.php">
    <input type="submit" name="Logout" value="Logout"/>
</form>
</div>