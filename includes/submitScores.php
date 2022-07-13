<?php
include 'database.php';
include 'functions.php';
include 'header.php';

if(isset($_POST['t1Score']) and isset($_POST['t2Score']) and isset($_POST['id'])){
    $team1Score = $_POST['t1Score'];
    $team2Score = $_POST['t2Score'];
    $matchInfo = getMatchInfo($_POST['id'], $conn);
    $t1Conf = $matchInfo['team1Confirm'];
    $t2Conf = $matchInfo['team2Confirm'];
    $t1Cap = getTeamInfo($conn, $matchInfo['team1ID'])['captinID'];
    $t2Cap = getTeamInfo($conn, $matchInfo['team2ID'])['captinID'];
    if(isset($_SESSION['userID']) and ($_SESSION['userID'] == $t1Cap or $_SESSION['userID'] == $t2Cap)){
        $confirmState  = $matchInfo['team1Confirm'] + $matchInfo['team2Confirm'];
        $header;
        if($_SESSION['userID'] == $t1Cap){
            $confirm = "team1Confirm = '1', team2Confirm =' 0'";
        }else{
            $confirm = "team2Confirm = '1', team1Confirm = '0'";
        }       
        if($confirmState == 0){
            $header = "wait";
            $sql = 'UPDATE matches SET team1Score = "'.$team1Score.'", team2Score = "'.$team2Score.'", '.$confirm.'  WHERE matchID = "'.$_POST['id'].'";';
            
        }elseif($confirmState == 1){
            if($team1Score == $matchInfo['team1Score'] and $team2Score == $matchInfo['team2Score']  ){
                $sql = 'UPDATE matches SET '.$confirm.', completed = 1  WHERE matchID = '.$_POST['id'];
                $header = "confirm";
                addToTeam($_POST['id'],$team1Score, $matchInfo['team1ID'], $team2Score, $matchInfo['team2ID'], $conn);
            }else{
                $sql = 'UPDATE matches SET team1Score ='.$team1Score.', team2Score ='.$team2Score.', '.$confirm.'  WHERE matchID = '.$_POST['id'];
                $header = "wait";
            }
        } 
        $result = mysqli_query($conn, $sql);
        header("location: ../matchPage.php?id=".$_POST['id']."&score=".$header );
        exit;
    }else{
        header("location: ../index.php" );
        exit;
    }
}else{
    header("location: ../index.php" );
    exit;
}