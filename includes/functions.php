<?php
function matchingStrings($str1, $str2){
    if ($str1 == $str2){
        return true;
    }else{
        return false;
    }
}
function usernameExists($conn, $username){
    //goto createUsers Function for more detailed comments on prepared statments 
    $sqlCode = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlCode)) { //ckecks if sql code is not valid
        header("Location: ../Signup.php?signup=sqlerr");
        exit;
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultDat = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultDat)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}
function convertTFtoBinary($TF){
    if($TF){
        return 1;
    }else{
        return 0;
    }
}
function createUser($conn, $username, $password)   {
$defaultSub = 0;
$defaultTeam = 0;
//using prepared statments to upload data (https://www.youtube.com/watch?v=I4JYwRIjX6c)
$sql = "INSERT INTO users (username,paswrd,isSubstitute,teamID) values (?,?,?,?)"; //template
$stmt = mysqli_stmt_init($conn); //conncets and initialises a statment
if (!mysqli_stmt_prepare($stmt,$sql)){ //checks statment is valid
    //if not
    header("Location: ../Signup.php?signup=sqlerr");
} else{
    mysqli_stmt_bind_param($stmt,'ssii',$username,$password,$defaultSub,$defaultTeam);//set values
    mysqli_stmt_execute($stmt);//execute 
}

} 
function loginUser($conn, $username, $password){

    $usernameData = usernameExists($conn, $username); //checks if username is valid
    if ($usernameData == false){
        header("Location: ../Login.php?login=invalid");
        exit;
    }

    $passwordOfUser = $usernameData["paswrd"];
    if (!matchingStrings($passwordOfUser, $password)){
        header("Location: ../Login.php?login=invalid");
        exit;
    }else{
        //username and pass is correct
        session_start();
        $_SESSION["userID"] = $usernameData["id"];
        $_SESSION["username"] = $usernameData["username"];
        $_SESSION["sub"] = $usernameData["isSubstitute"];
        $_SESSION["teamID"] = $usernameData["teamID"];
        header("Location: ../index.php");
        exit;
    }
}

function getTeamInfo($conn,$teamID){
    $sql = "SELECT * FROM teams WHERE teamID = ".$teamID;
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0){
        $dict = mysqli_fetch_assoc($result);    
        return $dict; //returns a dictionarry of the team
    }else{
        return false;
    }
}

function GetPlayerNamesFromTeamID($conn, $teamID){
    $sql = "SELECT * FROM users WHERE teamID = ".$teamID;
    $result = mysqli_query($conn,$sql);
    $arr = array();
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr,$row[1]);
        }
        //include the id aswell as names
    return $arr; //returns a dictionarry of the team
    }else{
        return false;
    }
}