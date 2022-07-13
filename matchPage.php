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


<div class="tooltip" style= "position: fixed; bottom: 0; right: 0;">
    <div style="float: left; width: 350px; background-color: rgb(220,220,220);  padding:10px;" class="tooltiptext"><a >View details on a match. If you are the team captin of one of the playing teams you are able to schedule matches and submit scores</a></div>
    <a ><img style="width: 60px; padding: 20px;" src="images/help.png"></a> 
</div>


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


        <tr >
            <td><a class="center remHref" href="teamPage.php?id='.$team1Info['teamID'].'" style="font-size: 40px;">'.$team1Info['teamName'].'<img  class="matchPageImage" src="teamLogos/'.$team1Info['teamLogo'].'"></a><a class="center">'.$team1Info['score'].' Pts.</a></td>
            <td><a class="center">Vs</a></td>
            <td><a class="center remHref" href="teamPage.php?id='.$team2Info['teamID'].'"style="font-size: 40px;">'.$team2Info['teamName'].'<img class="matchPageImage"  src="teamLogos/'.$team2Info['teamLogo'].'"></a><a class="center">'.$team2Info['score'].' Pts.</a></td>
        </tr>
        </table>
        </div>
        <div style="margin-top: 2%;"class="center">
        <br>
        <table style="width: 30%;">
            <tr style="background-color: rgb(220,220,220);">
                <th><a>Match Time</a></th>
                <th><a>Scores</a></th>
                <th><a>Status</a></th>
            </tr>
            <tr style="background-color: rgb(240,240,240);">

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
                if($matchInfo['completed'] == 0){
                    echo'N/A';
                    $played = false;
                }else{
                    echo $matchInfo['team1Score']." - ".$matchInfo['team2Score'];
                }

               echo'  
                </a></td>

               
                <td><a class="center">';
                if($scheduled == false){
                    echo 'To Be Scheduled'; 
                }else{
                    if($matchInfo['completed'] == 1){
                        echo'Completed';
                    }else{
                        echo'Waiting On Scores';
                    }
                }
                
                
                
                echo'</a></td>    
        </tr>
        </table>
        </br>
        </div>
        ';
        if(isset($_GET['schedule']) ){
            if($_GET['schedule'] == 'succ'){
                echo '<a style="margin: 10px;" class = "center success">Updated Time</a>';
            }elseif($_GET['schedule'] == 'past'){
                echo '<a style="margin: 10px;" class = "center error">Cannot Schedule Game In The Past</a>';
            }   
        }
        if(isset($_GET['score']) ){
            if($_GET['score'] == 'wait'){
                echo '<a style="margin: 10px;" class = "center success">Waiting for Other Team To Confirm</a>';
            }elseif($_GET['score'] == 'confirm'){
                echo '<a style="margin: 10px;" class = "center success">Completed</a>';
            }   
        }
        if(isset($_SESSION['userID']) and ($_SESSION['userID'] == $team1Info['captinID'] or $_SESSION['userID'] == $team2Info['captinID']) and $matchInfo['completed'] == 0){
            if($matchInfo['team1Score'] != null){
                $t1s = $matchInfo['team1Score'];
                $t2s = $matchInfo['team2Score'];
                $text = 'Confirm';
            }else{
                $t1s = 0;
                $t2s =0;
                $text = 'Submit';
            }
            $t1Cap = getTeamInfo($conn, $matchInfo['team1ID'])['captinID'];
            $t2Cap = getTeamInfo($conn, $matchInfo['team2ID'])['captinID'];
            echo'
            <div style="margin-left: 20%; margin-right: 20%;">
            <button  class="collapsible">Schedule Game</button>
            <div class="content"  >
            <form class="center" action = "includes/scheduleGame.php" method = "POST">
                <input class="center" style="margin: 20px;" type="datetime-local" name="datetime">
                <input type="submit" value="Submit">
                <input type="hidden" value="'.$_GET['id'].'" name="id">
            </form>
            </div>
            <button  class="collapsible">Submit Scores</button>
            <div class="content center" >
                <table style="width: 40%; margin: 5%;">
                <tr style="background-color: rgb(220,220,220);">
                    <th><a>Team 1 Score</a></th>
                    <th><a>Team 2 Score</a></th>
                    <th></th>
                </tr>
                <tr style="background-color: rgb(240,240,240);">
                    <form action = "includes/submitScores.php" method = "POST">
                    <th><input value="'.$t1s.'" type="number"  min="0" name="t1Score"></th>
                    <th><input value="'.$t2s.'" type="number" min="0" name="t2Score"></th>
                    <th><input type="submit" value="'.$text.'"  name="submit"><input name="id" type="hidden" value="'.$_GET['id'].'"></th>
                    </form>

            </div>
            </div>';
        }



    }else{
        header('Location: index.php');
        exit;
    }
}else{
    header('Location: index.php');
    exit;
}
?>
<script>
var collapseElement = document.getElementsByClassName("collapsible"); //node List (list of elements)
var i;

for (i = 0; i < collapseElement.length; i++) { //for all elements
    collapseElement[i].addEventListener("click", function() { //listen for clicks
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>