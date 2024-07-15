<?php

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

require '../config/init.php';

# Check If Image File Is A Actual Image Or Fake Image
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'Upload') {
    try {

        if (!isset($_COOKIE['Logined'])) {
            setErrorAndRedirect('You must register or log in to upload!', './');
        }

        $target_dir = '../uploads/';
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileType = explode('/', $_FILES['fileToUpload']['type']);

        if ($fileType[1] == 'x-zip-compressed') {
            $fileType[1] = 'zip';
        } elseif ($fileType[1] == 'mpeg') {
            $fileType[1] = 'mp3';
        } elseif ($fileType[1] == 'octet-stream') {
            $fileType[1] = 'rar';
        }

        if (file_exists($target_dir . $fileName) || stripos($fileName, ' ') || strlen($fileName) > 10) {
            $fileName = fileNameCreate() . '.' . $fileType[1];
        }

        $targetFile = $target_dir . $fileName;
        $uploadOk = 1;


        # Check File Size
        if ($_FILES["fileToUpload"]["size"] > Limit) {
            $uploadOk = 0;
            setErrorAndRedirect('The size of the selected file exceeds the limit!', './');
        }

        # Allow Certain File Formats
        if (!in_array($fileType[1], AllowedFormat)) {
            $uploadOk = 0;
            $message = 'Only files ';
            foreach (AllowedFormat as $AllowedFormat) {
                $message .=  '<b>' . strtoupper($AllowedFormat) . '</b> ';
            }
            setErrorAndRedirect($message . ' are allowed!', './');
        }

        # Check If Upload Ok is Set To 0 By An Error
        if ($uploadOk == 0) {
            setErrorAndRedirect('Sorry, there was an error uploading your file!', './');

            # If Everything Is Ok, Try To Upload File
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                $cookieValue = explode('-.-', encodeORdecode($_COOKIE['Logined'])['deCode']);
                seveFile($cookieValue[1], BASE_URL . 'uploads/' . $fileName, $fileName);
                setMessageAndRedirect('The upload was successful!', './');
            } else {
                setErrorAndRedirect('Sorry, there was an error uploading your file!', './');
            }
        }
    } catch (Exception $e) {
        setErrorAndRedirect('Sorry, there was an error uploading your file!', './');
    }
}

/* 
 * Developed by Hero Expert 
 * Telegram channel: @HeroExpert_ir
*/

?>
