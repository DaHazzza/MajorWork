<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<script src='https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.js'></script>
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
    <!--i k now im bad at css -->
    <div style="margin: 10%; margin-top: 50px;" >
        <div >
            <a style="font-size: xx-large; font-weight: bold; ">'.$info['teamName'].'</a>
            <a style="font-size: large; padding-left: 10px;">#'.$info['rank'].'</a>
            <br>
            <img src="teamLogos/'.$info['teamLogo'].'" alt="Team Logo" style="border-width: 5px; border-style: solid;
            border-color: Black; border-radius: 10px;">
            
            <a>ID:'.$info['teamID'].'</a>
            <div  style="display: inline-block; position: relative; bottom: 100px; ">
            <ul style="list-style-type:none">
                ';
                foreach (GetPlayerNamesFromTeamID($conn, $_GET['id']) as $j => $i){
                    echo '<li class="teamPlrLi"> <a class="teamPlrLiA"';if($j == $info["captinID"]){echo'style="text-decoration: underline;"';} echo' href="profilePage.php?user=',$j,'">',$i,'</a></li>';
                }
                echo '
            </ul>
        </div>

    </div>
        <div>
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
            echo '<button class="collapsible">Matches </button>';
            echo' <div class="content"> <table style="margin-left: 35%;">
            <tr>
            <th >Team 1</th>
            <th > </th>
            <th >Vs</th>
            <th > </th>
            <th >Team 2</th>
            <th >Time</th>
            <th >Match Page</th>
            </tr>';
            foreach(csvToArr($info['previousMatchIds'])as $i){
                $match = getMatchInfo($i,$conn);
                $team1Info = getTeamInfo($conn, $match['team1ID']);
                $team2Info = getTeamInfo($conn, $match['team2ID']);
                echo '<tr> <td>';
                echo "<a  class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$match['team1ID']."'>  " .$team1Info['teamName'].'  </a>';
                echo '</td> <td>';
                echo  '<img  class="center" src="teamLogos/'.$team1Info["teamLogo"].'" alt="Team Logo" width=40>';
                echo '</td> <td>';
                echo "<a class='center' style='color: black; text-decoration: none;' href='matchPage.php?id=".$match['matchID']."'>VS</a>" ;
                echo '</td> <td >';
                echo  '<img class="center" src="teamLogos/'.$team2Info["teamLogo"].'" alt="Team Logo" width=40>';
                echo '</td> <td >';
                echo "<a class='center' style='color: black; text-decoration: none;' href='teamPage.php?id=".$match['team2ID']."'>  " .$team2Info['teamName'].'  </a>';
                echo '</td> <td>';
                if ($match['matchTime'] != null){
                    echo '<a class="center">'.date("M d Y H:i",$match['matchTime'] +( 3600*8)).'</a>';
                }else{
                    echo'<a class="center">N/A </a>';
                }
                    echo '</td> <td >';     
                    echo  '<a href="matchPage.php?id='.$match['matchID'].'"><img class="center" src="images/matchLink.png" alt="Match Link" width=40 style="margin-left: 40%;"></a>';
                    echo '</td>  </tr>';
            }
            }echo'</table>';} //taken and adapted from matches.php ?> 
                
 </table></div>

      
        
        <?php
    if (isset($_SESSION["username"]) and $_SESSION["userID"] ==$info ['captinID'] ){
        //if logged in user if the team captin 
        echo'
        <button class="collapsible">Captin Actions</button>
        <div class ="content">
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
    echo"</div>";
    }

}else{
echo '<a class="center" style="margin-top: 5%; font-size: 40px;">'.$info['teamName'].' No Longer Exists</a>';

}
}else{
    header("Location: teams.php");
    exit;
}





?> 

<div>
    <?php

    $arr = [];
    $lables = [];
    $teamID = $_GET['id'];
    $prevMatch = csvToArr($info['previousMatchIds']);
    
    foreach($prevMatch as $j => $i){
        $matchInfo = getMatchInfo($i,$conn) ;  
        if ($matchInfo){
            if($teamID == $matchInfo['team1ID']){
                if($matchInfo['team1Score']){
                    array_push($arr,$matchInfo['team1Score']);
                    $team1Name = getTeamInfo($conn,$matchInfo['team1ID'])['teamName'];
                    $team2Name = getTeamInfo($conn,$matchInfo['team2ID'])['teamName'];
                    $str = $team1Name." VS ".$team2Name;
                    array_push($lables,$str);
                }
                
            } 
            if($teamID == $matchInfo['team2ID']){
                if($matchInfo['team2Score']){
                    array_push($arr,$matchInfo['team2Score']);
                    $team1Name = getTeamInfo($conn,$matchInfo['team1ID'])['teamName'];
                    $team2Name = getTeamInfo($conn,$matchInfo['team2ID'])['teamName'];
                    $str = $team1Name." VS ".$team2Name;
                    array_push($lables,$str);
                }
                
            } 
        }


    }

    ?>
</div>
<script>

</script>
    <button class="collapsible">Data</button>
<div class="content" id='chartDiv' >
    <canvas style=" border:1px solid #000000;" id='chart' width="900"  height="500"  id='canvas'></canvas>
    <a id='errTxt' class='error'>This Team Must Complete At Least 2 Matches To View This Data</a>
</div>
<script type='module'>    
import lineGraoph from '/MajorWork/includes/graph.js'
var passedArray = 
    <?php 
    if (count($arr) > 1){
        echo json_encode($arr);
    }else{
        echo '"invalid"';
    }
     ?>;

    if (passedArray != 'invalid'){
        var lables = <?php 
            
            echo json_encode($lables);
            ?>

        console.log(lables);
        
        var data = {
            yAxis: passedArray,
            border: [40,50],
            lables: lables,
            yLable: 'Points'
        }
        var canvasElement = document.getElementById('chart');
        var canvasDivWidth = document.getElementById('chartDiv').offsetWidth; // make the canvas as wide as the div
        var errText = document.getElementById('errTxt');
        errText.style.display = 'none';
        canvasElement.width = canvasDivWidth-50
        lineGraoph(data,canvasElement);
        console.log('graph')
    }else{
        var canvasElement = document.getElementById('chart');
        canvasElement.style.display = 'none';
        console.log('err')
    }

</script>
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


</div>