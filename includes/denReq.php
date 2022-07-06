<?php 
    session_start();
    include_once("database.php"); 
    include_once("functions.php");

    if (isset($_GET['reqID'])){
        $sql = 'SELECT * FROM joinrequests WHERE id = '.$_GET['reqID'];
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $dict = mysqli_fetch_assoc($result);
            $teamInfo = getTeamInfo($conn, $dict['teamID']);
            if($teamInfo and $teamInfo['captinID'] == $_SESSION['userID']){
                    $sql = 'DELETE FROM joinrequests WHERE id = '.$_GET['reqID'];
                    $result = mysqli_query($conn, $sql);
                header("Location: ../requests.php");
                exit;
            }else{
                header("Location: ../requests.php?state=validationErr");
                exit;
            }
        }else{
            header("Location: ../requests.php?state=requestErr");
            exit;
        }
    }else{
        header("Location: ../index.php");
        exit;
    }