<?php 
    session_start();
    include_once("database.php"); 
    include_once("functions.php");

    if (isset($_GET['reqID'])){
        $sql = 'SELECT * FROM joinrequests WHERE id = '.$_GET['reqID'];
        $result = mysqli_query($conn, $sql);
        if($result){
            $dict = mysqli_fetch_assoc($result);
            $teamInfo = getTeamInfo($conn, $dict['teamID']);
            $teamPlayers = GetPlayerNamesFromTeamID($conn, $dict['teamID']);
            $userInfo = getUserInfo($dict['userId'], $conn);
            if($teamInfo and $teamInfo['captinID'] == $_SESSION['userID'] and count($teamPlayers) < 6 and $userInfo['teamID'] == 0){
                $sql = 'UPDATE users SET teamID = '.$dict['teamID'].' WHERE id = '.$dict['userId'];
                $result = mysqli_query($conn, $sql);
                $sql = 'DELETE FROM joinrequests WHERE id = '.$_GET['reqID'];
                $result = mysqli_query($conn, $sql);
                if(count($teamPlayers) == 5){
                    $sql = 'DELETE FROM joinrequests WHERE teamID = '.$dict['teamID'];
                    $result = mysqli_query($conn, $sql);
                }

                header("Location: ../teamPage.php?id=".$dict['teamID']);
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