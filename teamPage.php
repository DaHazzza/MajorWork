<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<body style="margin:0%;"> 
    <?php


 include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>

<?php

$info;
if (isset($_GET['id']) && $_GET['id'] != ""){
    $info = getTeamInfo($conn,$_GET['id']);
    if  ($info != False){
        if ($info['deleted'] == 0){ 
        echo '
    <!--i know im bad at css -->
    <div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;" >
        <div style="width: 30%; margin: 0; position:absolute">
            <a style="font-size: xx-large; font-weight: bold; ">'.$info['teamName'].'</a>
            <a style="font-size: large; padding-left: 10px;">#'.$info['rank'].'</a>
            <br>
            <img src="teamLogos/'.$info['teamLogo'].'" alt="Team Logo" style="border-width: 5px; border-style: solid;
            border-color: Black; border-radius: 10px;"><br>
            <a>ID:'.$info['teamID'].'</a>
        </div>
        <div style="position: absolute; margin-left: 15%; margin-top:5%;"  >
            <ul style="list-style-type:none">
                ';
                foreach (GetPlayerNamesFromTeamID($conn, $_GET['id']) as $j => $i){
                    echo '<li class="teamPlrLi"> <a class="teamPlrLiA"';if($j == $info["captinID"]){echo'style="text-decoration: underline;"';} echo' href="profilePage.php?user=',$j,'">',$i,'</a></li>';
                }
                echo '
            </ul>
        </div>
        <div style="position: absolute; margin-top: 15%;">
            <table>
            <tbody>
            <tr >
                <th class="teamStatsTH">Games Played</th>
                <th class="teamStatsTH">Wins</th>
                <th class="teamStatsTH">Losses</th>
                <th class="teamStatsTH">Total Points Scored</th>
            </tr>
            <tr>
                <th>'. strval( $info['wins']+$info['losses']).'</th>
                <th>'.$info['wins'].'</th>
                <th>'.$info['losses'].'</th>
                <th>'.$info['pointsScored'].'</th>
            </tr>
            </tbody>
            </table>'
        ;
        if ($info['previousMatchIds'] != null){
            echo '<a style="font-size: xx-large; font-weight: bold; ">Past Matches</a>';
            echo' <table>';
            foreach(csvToArr($info['previousMatchIds'])as $i){
                    $matchInfo = getMatchInfo($i,$conn);
                    if ($matchInfo){
                        $team1Info = getTeamInfo($conn, $matchInfo['team1ID']);
                        $team2Info = getTeamInfo($conn, $matchInfo['team2ID']);
                        echo '<tr><td><a href="matchPage.php?id='.$matchInfo['matchID'].'">'.$team1Info['teamName']." VS ".$team2Info['teamName'].'</a></td></tr>';
                    }
            }} ?>
                


        </table>

        <?php
    if (isset($_SESSION["username"]) and $_SESSION["userID"] ==$info ['captinID'] ){
        //if logged in user if the team captin 
        echo'
        <a style="font-size: xx-large; font-weight: bold; ">Captin Actions</a>
        <form action="includes/upload.php" method="post" enctype="multipart/form-data">
        Upload New Team Logo:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
        <input type="hidden" name="teamID" value="',$info["teamID"],'" />
    </form>
    ';
    if (isset($_GET['state'])){
            $state = $_GET['state'];
            switch($state){
                case 'invalidType':
                    echo '<a class="error">Invalid File Type Please use jpg,png,gif,jpeg</a>';
                case 'inavlidSize':
                    echo'<a class="error">Invalid Image Size Ensure The image is 200 x 200</a>';
                case'upldErr':
                    echo'<a class="error">Error Uploading Image</a>';
                case 'success';
                    echo'<a class="success">Succsesfully Changed Logo</a>';
            }
    }
    echo'
    <form action="includes/renameTeamScript.php" method="post">
    Rename Team:
    <input type="text" name="name" id="name">
    <input type="submit" value="Submit" name="submit">
    <input type="hidden" name="teamID" value="',$info["teamID"],'" />
    </form> </br>';
    foreach (GetPlayerNamesFromTeamID($conn, $_GET['id']) as $j => $i){
        if ($j != $info['captinID']){
            echo $i.
            '
            <form action = "includes/kickPlayer.php" method="post">
                <input type="hidden" name="teamID" value="',$info["teamID"],'" />
                <input type="hidden" name="playerID" value="',$j,'" />
                <input type="submit" value="Kick" name="submit">
                <input type="hidden" name="type" value="kick" />
            </form>'.
            '<form action = "includes/promotePlayer.php" method="post">
                <input type="hidden" name="teamID" value="',$info["teamID"],'" />
                <input type="hidden" name="playerID" value="',$j,'" />
                <input type="submit" value="Promote" name="submit">
            </form></br>';
        }
    }
    }
    echo"</div></div>";
}else{
echo '<a class="center" style="margin-top: 5%; font-size: 40px;">'.$info['teamName'].' No Longer Exists</a>';

}
}else{
    header("Location: teams.php");
    exit;
}
}else{
    header("Location: teams.php");
    exit;
} 




?> 


