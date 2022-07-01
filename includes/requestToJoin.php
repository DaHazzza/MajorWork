<?php 
include "header.php";


if(isset($_POST['id']) and isset($_SESSION['userID'])){
    $sql = "INSERT INTO joinrequests  (teamID, userId) VALUES (".$_POST['id'].", ".$_SESSION['userID'].")";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location: ../teamPage.php?id=".$_POST['id'].'&state=request');
        exit;       
    }else{
        header("location: ../teamPage.php?id=".$_POST['id'].'&state=err');
        exit;     
    }

}else{
    header("location: ../index.php");
    exit;
}