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
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >the details of a user. If this is your own account you can leave your team and logout from here</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>

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
            <a style="font-size: 50px; font-weight: bold; margin: 30px; margin-top: 60px;   " class="center">'.$userInfo['username'].'</a>';
        if ($userInfo['teamID'] != 0){
            $teamInfo = getTeamInfo($conn,$userInfo['teamID']);
            if($teamInfo){
                echo'
                <div class="searchBar center">
                <img src="teamLogos/'.$teamInfo['teamLogo'].'" alt="Team Logo" width=40>
                <a style="font-size: 40px; font-weight: bold; text-decoration: none; color: black;" href="teamPage.php?id='.$teamInfo["teamID"].'">'.$teamInfo['teamName'].'</a>';
               
                if(isset($_GET["user"]) == false){
                   ?>
                    <form action="includes/kickPlayer.php" method="POST" onsubmit="return confirm('Leave Team?');">
                        <input clss = "center" style="margin:10px;"type="submit" name="Leave" value="Leave"/>
                        <?php
                        echo '
                        <input type="hidden" name="playerID" value="'.$userInfo['id'].'"/>
                        <input type="hidden" name="teamID" value="'.$teamInfo['teamID'].'"/>
                        <input type="hidden" name="type" value="leave"/>
                    </form>

                   </div>
                    ';
                    
                }
            }
        }
        if(isset($_GET["user"]) == false){
            echo '
            <div class="center  ">';
            ?>
                <form action="includes/logout.php" onsubmit="return confirm('Logout?');">
                    <input type="submit" name="Logout" value="Logout"/>
                </form>      
            <?php
        }
        echo'</div>';


                echo'
            </div>';
    }else{
        header('Location: index.php');
        exit;}
    ?>


</div>