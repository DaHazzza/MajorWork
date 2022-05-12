<?php
include 'database.php';
include 'functions.php';
$uid = $_POST['playerID'];
$tid = $_POST['teamID'];
echo $tid;


$players = GetPlayerNamesFromTeamID($conn,$tid);

$sql = 'UPDATE users SET teamID = 0 WHERE id ='.$uid.';';
$result = mysqli_query($conn,$sql);
$teamInfo = getTeamInfo($conn,$tid);

print_r($players);
if ($teamInfo['captinID'] == $uid and count($players ) > 1  ){

    $newCap = array_search( array_values($players)[0],$players);
    $sql = 'UPDATE teams SET captinID = '.$newCap.' WHERE teamID ='.$tid.';';
    $result = mysqli_query($conn,$sql);
}
$players = GetPlayerNamesFromTeamID($conn,$tid); #if no more plaers the team will be deleted
if ($players == false){
    delTeam($conn,$tid);
}
if ($_POST['type'] == 'kick'){
    header("location: ../teamPage.php?id=".$tid);
    exit;
}elseif($_POST['type'] == 'leave'){
    header("location: ../profilePage.php");
    exit;
}
