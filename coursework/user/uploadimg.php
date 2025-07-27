<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
    // Check file type
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['upload_error'] = 'File is not an image.';
        redirectBack($context, $questionId);
        $uploadOk = 0;
    }

    // Check if file already exists
        if (file_exists($target_file)) {
        $_SESSION['upload_error'] = 'Sorry, file already exists.';
        redirectBack($context, $questionId);
        $uploadOk = 0;
        exit();
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['upload_error'] = 'Sorry, your file is too large.';
        redirectBack($context, $questionId);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_SESSION['upload_error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        redirectBack($context, $questionId);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION['upload_error'] = 'Sorry, your file was not uploaded. Try again!';
        redirectBack($context, $questionId);

    // If everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header('Location: forum.php');
        exit();
      } else {
        $_SESSION['upload_error'] = 'Sorry, there was an error uploading your file.';
        redirectBack($context, $questionId);
      }
    }    
} else {
    // No image, skip uploading
    $uploadOk = 0;
    $target_file = null;
}

function redirectBack($context, $questionId = null) {
    if ($context === 'edit' && $questionId) {
        header("Location: editquestion.php?id=" . urlencode($questionId));
    } else {
        header("Location: addquestion.php");
    }
    exit();
}


$GLOBALS['uploadOk'] = $uploadOk;
$GLOBALS['target_file'] = $uploadOk ? $target_file : null;

?>