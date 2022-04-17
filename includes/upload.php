<?php
$target_dir = "../teamLogos/";
include 'database.php';

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$error = 0;
$id = $_POST['teamID'];
//check if file is an image
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"  ){
    header("location: ../teamPage.php?state=invalidType&id=".$id);
    $error =1;
    exit;
}

//validate size
$sizeCheck = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($sizeCheck[0] != 200 && $sizeCheck[1] != 200 && $error == 0){
    header("location: ../teamPage.php?state=inavlidSize&id=".$id);
    $error = 1;
    exit;
}

echo $error;
//upload file
if ($error == 0){
    echo "passed";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$id.".".$imageFileType)) {
        $sql ='UPDATE teams SET teamLogo ="'.$id.".".$imageFileType.'" WHERE teamID ='.$id;
        $result = mysqli_query($conn,$sql);
        header("location: ../teamPage.php?state=success&id=".$id); 
    } else {
        header("location: ../teamPage.php?state=upldErr&id=".$id );
        exit;
    }
}

//todo rename file name to team id