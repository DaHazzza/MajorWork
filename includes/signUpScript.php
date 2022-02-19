<?php
if (isset($_POST['submit'])) { //looks if data is actually valid
    
    include_once("functions.php"); //imports functions used 
    include_once("database.php"); //allows us to use $conn for connection to database
    $username = $_POST["Username"];
    $password = $_POST["Pass"];
    $confirmPass = $_POST["confirmPass"];//get data

    if (!matchingStrings($password, $confirmPass)){
        header("Location: ../Signup.php?signup=confirm");
        exit;
    }

    if (empty($username) or empty($password)){
        header("Location: ../Signup.php?signup=empty");
        exit;
    }

    if (usernameExists($conn, $username)){
        header("Location: ../Signup.php?signup=exists");
        exit;
    }


    //if passes all checks 
    createUser($conn, $username, $password);
    loginUser($conn, $username, $password);
    
    
    

}
?>