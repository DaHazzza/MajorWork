<?php 
include 'database.php';
include 'functions.php';
include 'header.php';

if (isset($_SESSION['userID']) && $_SESSION["isAdmin"]== 1){
    if(isset($_POST['UserID']) && is_numeric($_POST['UserID'])){
        $user = getUserInfo($_POST['UserID'],$conn);
        if($user){
            $result = delUser($conn,$_POST['UserID']);
            header("location: ../adminMenu.php?state=userSuccess");
            exit;
        }else{
            print_r($user);
            header("location: ../adminMenu.php?state=invUid");
           exit;
        }
    }else{
        header("location: ../adminMenu.php?state=userPassErr");
        exit;
    }
}else{
    header("location: ../index.php");
   exit;
}
