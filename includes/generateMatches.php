<?php
include 'database.php';
include 'functions.php';
include 'header.php';

if(isset($_SESSION['userID']) and $_SESSION['isAdmin'] == 1){
    //ff curent matches
    $sql = 'SELECT * FROM matches WHERE completed = 0';
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        addLoss($conn, $row['team1ID']);
        addLoss($conn, $row['team2ID']);
        recalcPoints($row['team1ID'],$conn);
        recalcPoints($row['team2ID'],$conn);

    }

    $sql = 'UPDATE matches SET completed = 1';
    mysqli_query($conn, $sql);




    $sql = "SELECT * FROM teams  WHERE deleted = 0 ORDER BY score DESC";
    $teams = mysqli_query($conn,$sql);
    $count = 1  ;
    $prev;
    while ($row = $teams    ->fetch_assoc()) {
        if($count % 2 ==0){
            $sql = 'INSERT INTO matches (team1ID, team2ID) VALUES ('.$prev['teamID'].' , '.$row['teamID'].')';
            mysqli_query($conn, $sql);
            $sql = 'SELECT MAX(matchID) FROM matches';
            $result = mysqli_query($conn,$sql);
            $dict = mysqli_fetch_array ($result);  
            if($row['matchIds'] != null){
               $sql = 'UPDATE teams SET matchIds = "'.strval($row['matchIds']).','.$dict[0].'" WHERE teamID = '.$row['teamID'];
            }else{
                $sql = 'UPDATE teams SET matchIds = "'.$dict[0].'" WHERE teamID = '.$row['teamID'];
            }
            echo $sql.'</br>';
            mysqli_query($conn, $sql);

            if($prev['matchIds'] != null){
                $sql = 'UPDATE teams SET matchIds = "'.strval($prev['matchIds']).','.$dict[0].'" WHERE teamID = '.$prev['teamID'];
             }else{
                 $sql = 'UPDATE teams SET matchIds = '.$dict[0]." WHERE teamID = ".$prev['teamID'];
             }
             mysqli_query($conn, $sql);
        }else{
            $prev = $row;
        }
        $count += 1;
    }
    header("location: ../adminMenu.php" );
    exit;
}