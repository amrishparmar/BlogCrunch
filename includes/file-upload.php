<?php
/**
 * Uploads an image to the server, returning the path string if successful or throws an exception if there was an error
 * Based on example code from http://www.w3schools.com/php/php_file_upload.asp
 * @param string $target_dir
 * @return string
 * @throws Exception
 */
function upload_image($target_dir) {
    // check if the file already exists in the directory and prepend the current timestamp if so
    if (file_exists($target_dir.basename($_FILES["imageToUpload"]["name"]))) {
        $target_file = $target_dir.basename(date("Y-m-d H:i")." - ".$_FILES["imageToUpload"]["name"]);
    }
    else {
        // construct the full path and name of the target file
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
    }
    // get the extension of the file
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // get the image size, will return false if not a valid image
    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);

    // the message to output in the exception if an error occurs
    $error_message = "";

    // check the result of getimagesize
    if ($check) {
        $uploadOk = 1;
    }
    else {
        $error_message .= "Your file is not an image.";
        $uploadOk = 0;
    }

    // ensure that the size does not exceed our max allowed file size, 1500 KB in this case
    if ($_FILES["imageToUpload"]["size"] > 1500000) {
        $error_message .= "Your file is too large. ";
        $uploadOk = 0;
    }

    // check that the user has uploaded a file with a valid extension
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error_message .= "Only JPG, JPEG, PNG and GIF files are allowed. ";
        $uploadOk = 0;
    }

    // check if the value of uploadOk, if 0 then the upload failed
    if ($uploadOk == 0) {
        $error_message .= "Sorry, your file was not uploaded. ";
        throw new Exception($error_message);
    }
    else {
        // move the uploaded file from the temp directory to the permanent one
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
            // return the file path
            return $target_file;
        }
        else {
            throw new Exception("An error has occurred. Sorry, your file was not uploaded. ");
        }
    }
}

