<?php
include 'database.php';
include 'functions.php';
include 'header.php';

if (isset($_POST['datetime']) and isset($_POST['id'])){
    echo $_POST['id'];
    $unixTime =  strtotime($_POST['datetime'])-( 3600*8);
    if($unixTime > time()){
        $sql = "UPDATE matches SET matchTime = ".$unixTime." WHERE matchID =".$_POST['id'];
        $result = mysqli_query($conn, $sql);
        header("location: ../matchPage.php?schedule=succ&id=".$_POST['id'] );
        exit;
    }else{
        header("location: ../matchPage.php?schedule=past&id=".$_POST['id'] );
        exit;
    }   
}else{
    header("location: ../index.php" );
    exit;    
}