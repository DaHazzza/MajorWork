<?php
include 'database.php';
$uid = $_POST['playerID'];
$tid = $_POST['teamID'];

$sql = 'UPDATE teams SET captinID = '.$uid.' WHERE teamID ='.$tid.';';
$result = mysqli_query($conn,$sql);
header("location: ../teamPage.php?id=".$tid);
exit;