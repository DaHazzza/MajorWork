<?php
include 'database.php';
include 'functions.php';
if (isset($_POST['uid']) && isset($_POST['teamName'])){
    $uid = $_POST['uid'];
    $teamName = $_POST['teamName'];
    if($teamName != "" and strlen($teamName) <= 32){
        $uinfo = getUserInfo($uid,$conn);
        if ($uinfo['teamID'] == 0){
            $teamID = createTeam($teamName,$uid,$conn);
            joinTeam($uid,$teamID,$conn);
            header('Location: ../createTeam.php?state=success');
            exit;
        }else{
            header('Location: ../createTeam.php?state=inTeam');
            exit;            
        }
    }else{
        header('Location: ../createTeam.php?state=nameErr');
        exit;
    }
}else{
    header('Location: ../createTeam.php?state=passErr');
    exit;
}

