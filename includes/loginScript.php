<?php
if (isset($_POST['submit'])) { //looks if data is actually valid
    
    include_once("functions.php"); //imports functions used 
    include_once("database.php"); //allows us to use $conn for connection to database
    $username = $_POST["Username"];
    $password = $_POST["Pass"];

    if (empty($username) or empty($password)){
        header("Location: ../login.php?login=empty");
        exit;
    }
    loginUser($conn, $username, $password);
}else{
    header("Location: ../login.php");
    exit;
}
