<?php
include_once("database.php"); 
$name = $_POST['name'];
$id = $_POST['teamID'];
$sql = "UPDATE teams SET teamname = '".$name."' WHERE teamID =".$id;
$result = mysqli_query($conn,$sql);
echo $result;
header("location: ../teamPage.php?id=".$id)
?>