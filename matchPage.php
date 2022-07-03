<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="stylesheet.css">
<body style="margin:0%;"> 
    <?php
 include "includes/header.php";?> <!-- creates the Naviation Bar-->
</body>





<?php
if (isset($_GET['id'])){
    $matchID = $_GET['id'] ;
    $matchInfo = getMatchInfo($matchID,$conn);
    if($matchInfo != false){
        $team1Info = getTeamInfo($conn, $matchInfo['team1ID']);
        $team2Info = getTeamInfo($conn, $matchInfo['team2ID']);
        echo'
        <a>ID:'.$matchID.'</a>
        <div class="center" style="margin-top: 2%;">
        <table style="width: 40%;">
        <tr>
            <th> <a href="teamPage.php?id='.$team1Info['teamID'].'"><img src="teamLogos/'.$team1Info['teamLogo'].'" style="margin-right: 20px;"></a></th>
            <th>VS</th>
            <th> <a href="teamPage.php?id='.$team2Info['teamID'].'"><img src="teamLogos/'.$team2Info['teamLogo'].'" style="margin-right: 20px;"></a></th>
        </tr>
        <tr>
            <td><a class="center" style="font-size: 40px;">'.$team1Info['teamName'].'</a><a class="center">#'.$team1Info['score'].'</a></td>
            <td><a></a></td>
            <td><a class="center" style="font-size: 40px;">'.$team2Info['teamName'].'</a><a class="center">#'.$team2Info['score'].'</a></td>
        </tr>
        </table>
        </div>
        <div style="margin-top: 2%;"class="center">
        <br>
        <table style="width: 30%;">
            <tr>
                <th><a>Match Time</a></th>
                <th><a>Scores</a></th>
                <th><a>Status</a></th>
            </tr>
            <tr>

                <td><a class="center">';
                $scheduled ;
                $played;
                if ($matchInfo['matchTime'] != null){
                    echo date("d-m-Y g:i a",$matchInfo['matchTime'] +( 3600*8));
                    $scheduled = true;
                }else{
                    echo 'N/A';
                    $scheduled = false;
                }
                echo'</a></td>

                <td><a class="center">';
                if($matchInfo['team1Score'] == null){
                    echo'N/A';
                    $played = false;
                }else{
                    echo $matchInfo['team1Score']." - ".$matchInfo['team2Score'];
                    $played = true;
                }

               echo'  
                </a></td>

               
                <td><a class="center">';
                if($scheduled == false){
                    echo 'To Be Scheduled'; 
                }else{
                    if($played){
                        echo'Completed';
                    }else{
                        echo'Waiting On Scores';
                    }
                }
                
                
                
                echo'</a></td>    
        </tr>
        </table>
        ';
    }else{
        header('Location: index.php');
        exit;
    }
}else{
    header('Location: index.php');
    exit;
}
