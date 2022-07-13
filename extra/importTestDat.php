<?php

include_once("../includes/functions.php");
include_once("../includes/database.php");

$dict = [];

$currentTeam;
$lines = file('newTeams.txt', FILE_IGNORE_NEW_LINES);
$count = 0;
foreach($lines as $value){
    if (($count + 1) % 2 != 0){
        #team
        $currentTeam = $value;
        $count = $count +1;
    }else{
        #players
        $tempArr = explode(',',$value);
        $plrArr = [];
        foreach ($tempArr as $i){
            $trimmed = trim($i, "[ ");
            $trimmed = trim($trimmed, "] ");
            $trimmed = trim($trimmed, "' ");
            echo $trimmed."<br>";
            array_push($plrArr, $trimmed);
        }
        $dict[$currentTeam] = $plrArr;
        $count = $count +1;
        #$dict[$currentTeam] = 
    }
}

foreach($dict as $teamName => $value){
    $tid;
    foreach($value as $key => $player){
        if ($key == 0){
           $uid = createUser($conn, $player, 'pass');
            $tid = createTeam($teamName,$uid,$conn);
            joinTeam($uid,$tid,$conn);
        }else{
            $uid = createUser($conn, $player, 'pass');
            joinTeam($uid,$tid,$conn);
        }
    }
    
}