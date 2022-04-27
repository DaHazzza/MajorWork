<?php
include 'database.php';
$uid = $_POST['playerID'];
$tid = $_POST['teamID'];

$sql = 'UPDATE users SET teamID = 0 WHERE id ='.$uid.';';
$result = mysqli_query($conn,$sql);
header("location: ../teamPage.php?id=".$tid);
exit;