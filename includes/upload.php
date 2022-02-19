<?php
$target_dir = "../teamLogos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$error = 0;

//check if file is an image
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"  ){
    header("location: ../teams.php?state=inavlidType");
    $error =1;
}

//validate size
$sizeCheck = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($sizeCheck[0] != 200 && $sizeCheck[1] != 200 && $error == 0){
    header("location: ../teams.php?state=inavlidSize");
    $error = 1;
}

echo $error;
//upload file
if ($error == 0){
    echo "passed";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header("location: ../teams.php?state=success");
    } else {
        header("location: ../teams.php?state=upldErr");
    }
}

//todo rename file name to team id