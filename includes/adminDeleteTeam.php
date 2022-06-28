<?php 
include 'database.php';
include 'functions.php';
include "header.php";

if (isset($_SESSION['userID']) && $_SESSION["isAdmin"]== 1){
    if(isset($_POST['TeamID']) && is_numeric($_POST['TeamID'])){
        $team = getTeamInfo($conn,$_POST['TeamID']);
        if($team){
            $result = delteam($conn,$_POST['TeamID']);
            header("location: ../adminMenu.php?state=teamSuccess");
            exit;
        }else{
            header("location: ../adminMenu.php?state=invTid");
           exit;
        }
    }else{
        header("location: ../adminMenu.php?state=teamPassErr");
        exit;
    }
}else{
    header("location: ../index.php");
    exit;
}


?>
