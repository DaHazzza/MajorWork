<?php 
include "header.php";


if(isset($_POST['id']) and isset($_SESSION['userID'])){
    $sql = 'SELECT * FROM joinrequests WHERE  userId = '. $_SESSION['userID'].' AND teamID = '.$_POST['id'];
    $result = mysqli_query($conn, $sql);
    if  (mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO joinrequests  (teamID, userId) VALUES (".$_POST['id'].", ".$_SESSION['userID'].")";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location: ../teamPage.php?id=".$_POST['id'].'&state=request');
            exit;       
        }else{
            header("location: ../teamPage.php?id=".$_POST['id'].'&state=sqlerr');
            exit;     
        }
    }else{
        header("location: ../teamPage.php?id=".$_POST['id'].'&state=outgoing');
        exit;  
    }

}else{
    header("location: ../index.php");
    exit;
}