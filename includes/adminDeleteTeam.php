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
            print_r($team);
           // header("location: ../adminMenu.php?state=teamID");
           //exit;
        }
    }
}else{
    header("location: ../index.php");
    exit;
}


?>
